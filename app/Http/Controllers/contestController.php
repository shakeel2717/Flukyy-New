<?php

namespace App\Http\Controllers;

use App\Models\contest;
use App\Models\participate;
use App\Models\transaction;
use Illuminate\Http\Request;
use ZipArchive;

class contestController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'participate' => 'required|numeric',
            'price' => 'required|numeric',
        ]);
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

        $hash_code = rand(1, 5000);
        // $hash_code = 100;
        $encrypted_hash_code = md5($hash_code);
        $zip_password = md5($encrypted_hash_code . session('user')[0]->username . env('APP_KEY'));

        // inserting participate Request
        $task = new participate();
        $task->users_id = session('user')[0]->id;
        $task->contest_id = $contestActive[0]->id;
        $task->password = $encrypted_hash_code;
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
        $myfile = fopen("Flukehashe/$filename.txt", "w") or die("Unable to Open file!");
        $txt = "Fluke ID:" . $hash_code;
        fwrite($myfile, $txt);
        fclose($myfile);
        $zip = new ZipArchive();
        if ($zip->open("Flukehashe/$filename.zip", ZipArchive::CREATE) === TRUE) {
            $zip->setPassword($zip_password); //set default password
            $zip->addFile("Flukehashe/$filename.txt"); //add file
            $zip->setEncryptionName("Flukehashe/$filename.txt", ZipArchive::EM_AES_256); //encrypt it
            $zip->close();
            //deleting txt file for security resason
            unlink("Flukehashe/$filename.txt");
        } else {
            echo "Sorry, but there is an Error, Please contact Support";
            die();
        }

        return redirect()->back()->with('message', 'You are now Successfully Participated into a Contest');
    }
}