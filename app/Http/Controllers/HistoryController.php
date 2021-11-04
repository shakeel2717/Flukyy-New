<?php

namespace App\Http\Controllers;

use App\Models\transaction;
use App\Models\users;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function usdHistory()
    {
        $query = transaction::where('users_id',session('user')[0]->id)->where('currency','USD')->latest()->paginate();
        return view('dashboard.history.usd',[
            'query' => $query,
        ]);
    }


    public function tokenHistory()
    {
        $query = transaction::where('users_id',session('user')[0]->id)->where('currency','Token')->latest()->paginate();
        return view('dashboard.history.token',[
            'query' => $query,
        ]);
    }


    public function rewardHistory()
    {
        $query = transaction::where('users_id',session('user')[0]->id)->where('currency','Reward')->latest()->paginate();
        return view('dashboard.history.reward',[
            'query' => $query,
        ]);
    }

    public function referHistory()
    {
        $query = users::where('refer',session('user')[0]->username)->latest()->paginate();
        return view('dashboard.history.refer',[
            'query' => $query,
        ]);
    }
}
