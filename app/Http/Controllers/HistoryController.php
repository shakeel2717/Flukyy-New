<?php

namespace App\Http\Controllers;

use App\Models\transaction;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function usdHistory()
    {
        $query = transaction::where('users_id',session('user')[0]->id)->where('currency','USD')->paginate();
        return view('dashboard.history.usd',[
            'query' => $query,
        ]);
    }


    public function tokenHistory()
    {
        $query = transaction::where('users_id',session('user')[0]->id)->where('currency','Token')->paginate();
        return view('dashboard.history.token',[
            'query' => $query,
        ]);
    }


    public function rewardHistory()
    {
        $query = transaction::where('users_id',session('user')[0]->id)->where('currency','Reward')->paginate();
        return view('dashboard.history.reward',[
            'query' => $query,
        ]);
    }
}
