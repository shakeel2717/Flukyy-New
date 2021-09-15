<?php

namespace App\Http\Controllers;

use App\Models\contest;
use App\Models\participate;
use Illuminate\Http\Request;

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
        $contestCheckQuery = contest::where('contest',$contest)->count();
        if ($contestCheckQuery > 0) {
            goto contestCreate;
        }
        // checking if already running a contest
        $contestCheckAlreadyQuery = contest::where('status','Active')->count();
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
        $contestActive = contest::where('status','Active')->get();
        if (count($contestActive) < 1 ) {
            return redirect()->back()->withErrors('No Active Contest Found, Please Visit later.');
        }
        // inserting participate Request
        $task = new participate();
        $task->users_id = session('user')[0]->id;
        $task->contest_id = $contestActive[0]->id;
        $task->save();
        return redirect()->back()->with('message', 'You are now Successfully Participated into a Contest');


    }
}
