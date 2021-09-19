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
        if (balanceToken() < $contestActive[0]->price) {
            return redirect()->back()->withErrors('Insufficient Token Balance.');
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
        $task->currency = "Token";
        $task->amount = $contestActive[0]->price;
        $task->sum = "Out";
        $task->save();


        //creating text documeent with hash code
        $username = session('user')[0]->username;
        $filename = $username . $contestActive[0]->contest;
        fopen("flukehashe/$filename.txt", "w") or die("Unable to Create file!");
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

    public function contestEnd()
    {
        // checking running contest
        $contestActive = contest::where('status', 'Active')->first();
        $contestActive->status = "Investigating";
        $contestActive->save();
        echo "Contest Status Update <br>";
        //getting the winner
        $users = DB::table('votes')->select('contestid', 'vote', DB::raw('COUNT(vote) as `Votes`'))->where('contestid', $contestid[0]->contestid)->groupBy('contestid', 'vote')->havingRaw('COUNT(*) > 1')->orderBy('votes', 'desc')->limit(1)->get();
        $voteNumber = $users[0]->vote;
        // hasing this vote
        $voteNumberhashed = md5($voteNumber);
        //checking who have this hash
        $luckyQuery = DB::table('enrollments')->where('hash', $voteNumberhashed)->where('contestid', $users[0]->contestid)->get();
        // fetched the email of users
        if ($luckyQuery != "[]") {
            // insering the balance to that user $1000 usd
            $winnerAwards['email'] = $luckyQuery[0]->email;
            $winnerAwards['note'] = "Flukyy Team";
            $winnerAwards['amount'] = 1000;
            $winnerAwards['status'] = "Approved";
            $winnerAwards['contestid'] = $users[0]->contestid;
            $winnerAwards['note'] = "Flukyy Contester";
            Mail::to($luckyQuery[0]->email)->send(new flukyyUser());
            //checking if already paid
            $securityQuery = DB::table('flukyy')->where('email', $luckyQuery[0]->email)->where('contestid', $users[0]->contestid)->count();
            if ($securityQuery > 0) {
                return Redirect(route('dashboard'));
                die();
            }
            DB::table('flukyy')->insert($winnerAwards);
            //sending email to user
            //chekcing if this user have a valid refer
            $referUsername = DB::table('users')->where('email', $luckyQuery[0]->email)->get();
            $referEmail = DB::table('users')->where('username', $referUsername[0]->refer)->get();
            $referAwards['email'] = $referEmail[0]->email;
            $referAwards['note'] = "Flukyy Refer";
            $referAwards['amount'] = 50;
            $referAwards['status'] = "Approved";
            $referAwards['contestid'] = $users[0]->contestid;
            $referAwards['note'] = "Flukyy Refer Award";
            DB::table('flukyy')->insert($referAwards);
            // checking from voters list
            $luckyVotersQuery = DB::table('voters')->where('hash', $voteNumberhashed)->where('contestid', $users[0]->contestid)->get();
            if ($luckyVotersQuery !== "[]") {
                $winnerAwards['email'] = $luckyVotersQuery[0]->email;
                $winnerAwards['amount'] = 100;
                $winnerAwards['note'] = "Flukyy Voter";
                $securityQuery = DB::table('flukyy')->where('email', $luckyVotersQuery[0]->email)->where('contestid', $users[0]->contestid)->count();
                if ($securityQuery > 0) {
                    return Redirect(route('dashboard'));
                    die();
                }
                DB::table('flukyy')->insert($winnerAwards);
                return Redirect(route('admin.dashboard'));
            }
        }
        //sending Passwords to all users
        $contestid = DB::table('contests')->where('status', 'Investigating')->get();
        $contesters = DB::table('enrollments')->where('contestid', $contestid[0]->contestid)->get();
        foreach ($contesters as $contester) {
            $contesterEmail = $contester->email;
            $thisuserusername = DB::table('users')->where('email', $contesterEmail)->get();
            $contesterUsername = $thisuserusername[0]->username;
            $pass_query = DB::table('enrollments')->where('email', $contesterEmail)->where('contestid', $contestid[0]->contestid)->get();
            $password = md5($pass_query[0]->hash . $contesterUsername . env('APP_KEY'));
            Mail::to($contesterEmail)->send(new zipPassword($password));
            echo "Sent <br>";
        }
        $contesters = DB::table('voters')->where('contestid', $contestid[0]->contestid)->get();
        foreach ($contesters as $contester) {
            $contesterEmail = $contester->email;
            $thisuserusername = DB::table('users')->where('email', $contesterEmail)->get();
            $contesterUsername = $thisuserusername[0]->username;
            $pass_query = DB::table('voters')->where('email', $contesterEmail)->where('contestid', $contestid[0]->contestid)->get();
            $password = md5($pass_query[0]->hash . $contesterUsername . env('APP_KEY'));
            Mail::to($contesterEmail)->send(new zipPassword($password));
            // echo "Sent <br>";
        }
        return Redirect(route('admin.dashboard'));
    }
}
