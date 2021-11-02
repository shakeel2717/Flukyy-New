<?php

namespace App\Http\Controllers;

use App\Models\contest;
use App\Models\participate;
use App\Models\transaction;
use App\Models\users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ZipArchive;

class contestController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'participate' => 'required|numeric',
            'price' => 'required|numeric',
        ]);
        // getting current Contest
        $contestCheckQuery = contest::where('status', "Investigate")->first();
        if ($contestCheckQuery == "") {
            return redirect()->back()->withErrors('A previews contest is not yet Finish. Please wait');
        }
        // changiong the status of this contest
        $contestCheckQuery->status = "Complete";
        $contestCheckQuery->save();

        // getting the most voters in database to declare the winners
        $allVotes = DB::table('votes')
            ->select('value', DB::raw('COUNT(value) as count'))
            ->groupBy('value')
            ->orderBy('count', 'desc')
            ->first();
        $winnerHash =  md5($allVotes->value);
        // updating the status for the winner
        $winnerQuery = participate::where('contest_id', $contestCheckQuery->id)->where('password', $winnerHash)->get();
        $award = 1000;
        foreach ($winnerQuery as $winner) {
            // updating this user stautus in participate
            $task = participate::find($winner->id);
            $task->winner = 1;
            $task->save();
            // inserting this user Award
            $task = new transaction();
            $task->users_id = $winner->users_id;
            $task->type = "Award";
            $task->status = "Approved";
            $task->sum = "In";
            $task->currency = "USD";
            $task->amount = $award;
            $task->save();
            // sponser award
            if ($award == 1000) {
                // getting this user data
                $userDetail = users::find($winner->users_id);
                if ($userDetail->refer != "Default") {
                    $referDetail = users::where('username', $userDetail->refer)->first();
                    $task = new transaction();
                    $task->users_id = $referDetail->id;
                    $task->type = "Award Commission";
                    $task->status = "Approved";
                    $task->sum = "In";
                    $task->currency = "USD";
                    $task->amount = 50;
                    $task->save();
                }
            }
            $award = 100;
        }
        // inserting new fluke
        contestCreate:
        $contest = random(15);
        // checking if this contest already in use
        $contestCheckQuery = contest::where('contest', $contest)->count();
        if ($contestCheckQuery > 0) {
            goto contestCreate;
        }
        // checking if already running a contest
        $contestCheckAlreadyQuery = contest::where('status', 'Active')->count();
        if ($contestCheckAlreadyQuery > 0) {
            return redirect()->back()->withErrors('A Contest Already Running, Please wait until perviews one Finish');
        }
        // inserting new contest
        $task = new contest();
        $task->contest = $contest;
        $task->price = $validated['price'];
        $task->participate = $validated['participate'];
        $task->status = "Active";
        $task->save();
        return redirect()->back()->with('message', 'New Contest Created');
        return 1;
    }

    public function contestParticepateReq(Request $request)
    {
        // checking running contest
        $contestActive = contest::where('status', 'Active')->get();
        if (count($contestActive) < 1) {
            return redirect()->back()->withErrors('No Active Contest Found, Please Visit later.');
        }

        // checking if token balance is enough
        if (balanceReward() < $contestActive[0]->price) {
            return redirect()->back()->withErrors('Insufficient Reward Point.');
        }
        // checking if this user alrady participated in this Contest
        $alreadyContestParticipate = participate::where('users_id', session('user')[0]->id)->count();
        if ($alreadyContestParticipate > 0) {
            return redirect()->back()->withErrors('You already Participated into This Contest.');
        }

        // checking if any free space in Contest
        if ($contestActive[0]->participate <= count($contestActive[0]->participators)) {
            return redirect()->back()->withErrors('Sorry, There is no Free Space avaible for Participate.');
        }
        generateHashPass:
        $hash_code = rand(1, $contestActive[0]->participate);
        $encrypted_hash_code = md5($hash_code);
        // checking if this code already assinged to another memeber
        $participateCodeSecurity = participate::where('contest_id', $contestActive[0]->id)->where('type', 'Contester')->where('password', $encrypted_hash_code)->count();
        if ($participateCodeSecurity > 0) {
            goto generateHashPass;
        }

        $zip_password = $encrypted_hash_code;

        // inserting participate Request
        $task = new participate();
        $task->users_id = session('user')[0]->id;
        $task->contest_id = $contestActive[0]->id;
        $task->password = $encrypted_hash_code;
        $task->hash = $zip_password;
        $task->save();


        // getting out Token from balance
        $task = new transaction();
        $task->users_id = session('user')[0]->id;
        $task->status = "Approved";
        $task->type = "Participate";
        $task->currency = "Reward";
        $task->amount = $contestActive[0]->price;
        $task->sum = "Out";
        $task->save();


        //creating text documeent with hash code
        $username = session('user')[0]->username;
        $filename = $username . $contestActive[0]->contest;
        fopen("flukehashe/$filename.txt", "w") or die("Unable to Create file!");
        $myfile = fopen("flukehashe/$filename.txt", "w") or die("Unable to Open file!");
        $txt = "Fluke ID:" . $hash_code;
        fwrite($myfile, $txt);
        fclose($myfile);
        $zip = new ZipArchive();
        if ($zip->open("flukehashe/$filename.zip", ZipArchive::CREATE) === TRUE) {
            $zip->setPassword($zip_password); //set default password
            $zip->addFile("flukehashe/$filename.txt"); //add file
            $zip->setEncryptionName("flukehashe/$filename.txt", ZipArchive::EM_AES_256); //encrypt it
            $zip->close();
            //deleting txt file for security resason
            unlink("flukehashe/$filename.txt");
        } else {
            echo "Sorry, but there is an Error, Please contact Support";
            die();
        }

        return redirect()->back()->with('message', 'You are now Successfully Participated into a Contest');
    }
}
