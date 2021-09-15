<?php

namespace App\Http\Controllers;

use App\Models\contest;
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
}
