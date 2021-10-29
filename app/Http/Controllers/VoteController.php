<?php

namespace App\Http\Controllers;

use App\Models\contest;
use App\Models\participate;
use App\Models\transaction;
use App\Models\vote;
use Illuminate\Http\Request;
use ZipArchive;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'vote1' => 'required|integer|min:1',
            'vote2' => 'required|integer|min:1',
            'vote3' => 'required|integer|min:1',
            'vote4' => 'required|integer|min:1',
            'vote5' => 'required|integer|min:1',
            'vote6' => 'required|integer|min:1',
            'vote7' => 'required|integer|min:1',
            'vote8' => 'required|integer|min:1',
            'vote9' => 'required|integer|min:1',
            'vote10' => 'required|integer|min:1',
        ]);
        if (activeContest() == false) {
            return redirect()->back()->withErrors('No Contest Found');
        }
        $contestCheck = contest::where('status', 'Active')->first();
        // checking if this user already vote cast
        // checking if this user is contester or not
        $contester = participate::where('users_id', session('user')[0]->id)->where('contest_id', $contestCheck->id)->count();
        if ($contester > 0) {
            $type = "Contester";
        } else {
            $type = "Voter";
        }
        $voteSecurity = vote::where('user_id', session('user')[0]->id)->where('contest_id', $contestCheck->id)->count();
        if ($voteSecurity > 0) {
            return redirect()->back()->withErrors('you already Casted the Vote, Please Wait for Result');
        }

        $id = 1;
        foreach ($validated as $vote) {
            // inserting into database
            $task = new vote();
            $task->user_id = session('user')[0]->id;
            $task->contest_id = $contestCheck->id;
            $task->type = $type;
            $task->value = $validated['vote' . $id];
            $task->save();
            echo "Vote $id Successfully Inserted <br>";
            $id++;
        }
        if ($type == "Contester") {
            goto endVoteReq;
        }

        
        //creating text documeent with hash code
        $hash_code = rand(1, $contestCheck->participate);
        $encrypted_hash_code = md5($hash_code);
        $zip_password = md5($encrypted_hash_code . session('user')[0]->username . env('APP_KEY'));
        
        // inserting participate Request
        $task = new participate();
        $task->users_id = session('user')[0]->id;
        $task->type = "Voter";
        $task->contest_id = $contestCheck->id;
        $task->password = $encrypted_hash_code;
        $task->save();

        $username = session('user')[0]->username;
        $filename = $username . $contestCheck->contest;
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
        endVoteReq:
        return redirect()->back()->with('message', 'Your Vote Successfully Cast, Please wait the Resutl to see your Hash Password');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function show(vote $vote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function edit(vote $vote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, vote $vote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function destroy(vote $vote)
    {
        //
    }
}
