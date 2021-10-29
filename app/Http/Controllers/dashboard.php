<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\contest;
use App\Models\participate;
use App\Models\vote;
use Carbon\Carbon;
use Illuminate\Http\Request;

class dashboard extends Controller
{
    public function index()
    {
        $Activecontest = contest::where('status','Active')->first();
        // password for contester
        $participate = participate::where('users_id',session('user')[0]->id)->where('contest_id',$Activecontest->id)->get();
        $allVotes = vote::where('contest_id',$Activecontest->id)->get();
        $myVotes = vote::where('user_id',session('user')[0]->id)->where('contest_id',$Activecontest->id)->get();
        return view('dashboard.index',[
            'Activecontest' => $Activecontest,
            'participate' => $participate,
            'myVotes' => $myVotes,
            'allVotes' => $allVotes,
        ]);
    }

}
