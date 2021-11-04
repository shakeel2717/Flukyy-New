<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\contest;
use App\Models\participate;
use App\Models\vote;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dashboard extends Controller
{
    public function index()
    {
        $Activecontest = contest::where('status', 'Active')->orWhere('status', 'Investigate')->first();
        // password for contester
        $participate = participate::where('users_id', session('user')[0]->id)->where('contest_id', $Activecontest->id)->get();
        $allVotes = DB::table('votes')
        ->where('contest_id', $Activecontest->id)
            ->select('value', DB::raw('COUNT(value) as count'))
            ->groupBy('value')
            ->orderBy('count', 'desc')
            ->get();


        // return $allVotes;
        $myVotes = vote::where('user_id', session('user')[0]->id)->where('contest_id', $Activecontest->id)->get();
        // Declaring the Winners if contest is complete voting
        $totalVoters = participate::where('contest_id', $Activecontest->id)->where('type', "Voter")->count();
        if ($totalVoters >= $Activecontest->participate) {
            // End this Contest
            $contestFind = contest::find($Activecontest->id);
            $contestFind->status = "Investigate";
            $contestFind->save();
        }

        return view('dashboard.index', [
            'Activecontest' => $Activecontest,
            'participate' => $participate,
            'myVotes' => $myVotes,
            'allVotes' => $allVotes,
        ]);
    }



    public function contestRecord()
    {
        $participate = participate::where('users_id',session('user')[0]->id)->paginate();
        return view('dashboard.contest.index',[
            'participate' => $participate,
        ]);
    }
}
