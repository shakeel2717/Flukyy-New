<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\transaction;
use App\Models\users;
use Illuminate\Http\Request;

class convertController extends Controller
{
    // public function usdToToken()
    // {
    //     return view('dashboard.convert.usdToToken');
    // }


    public function tokenToUsd()
    {
        return view('dashboard.convert.tokenToUsd');
    }

    // public function usdToTokenReq(Request $request)
    // {
    //     $validated = $request->validate([
    //         'amount' => 'required|numeric',
    //     ]);
    //     // checking if balnace is enough
    //     if (balanceUsd() < $validated['amount']) {
    //         return redirect()->back()->withErrors('Insufficent Balance');
    //     }

    //     // converting balance
    //     // getting Token Rate
    //     $price = env('TOKEN_PRICE');
    //     // converting balance into Token
    //     $calc = $validated['amount'] / $price;

    //     // getting out Token from balance
    //     $task = new transaction();
    //     $task->users_id = session('user')[0]->id;
    //     $task->status = "Approved";
    //     $task->type = "Convert";
    //     $task->currency = "USD";
    //     $task->amount = $validated['amount'];
    //     $task->sum = "Out";
    //     $task->save();

    //     // inserting Token Transaction
    //     $task = new transaction();
    //     $task->users_id = session('user')[0]->id;
    //     $task->status = "Approved";
    //     $task->type = "Exchange";
    //     $task->currency = "Token";
    //     $task->amount = $calc;
    //     $task->sum = "In";
    //     $task->save();
    //     return redirect()->back()->with('message', 'Task Completed Successfully');

    //     return $price;
    // }


    public function tokenToUsdReq(Request $request)
    {
        $adminQuery = admin::get();
        $validated = $request->validate([
            'amount' => 'required|numeric',
        ]);
        // checking if balnace is enough
        if (balanceToken() < $validated['amount']) {
            return redirect()->back()->withErrors('Insufficent Balance');
        }

        // converting balance
        // getting Token Rate
        $price = $adminQuery[0]->token; // 0.55
        // converting balance into Token
        $calc = $validated['amount'] * $price;

        // getting out Token from balance
        $task = new transaction();
        $task->users_id = session('user')[0]->id;
        $task->status = "Approved";
        $task->type = "Convert";
        $task->currency = "Token";
        $task->amount = $validated['amount'];
        $task->sum = "Out";
        $task->save();

        // checking if this user already have a Reward point
        if (balanceReward() < 1) {
            // getting out Reward from balance
            $task = new transaction();
            $task->users_id = session('user')[0]->id;
            $task->status = "Approved";
            $task->type = "Earned free";
            $task->currency = "Reward";
            $task->amount = $adminQuery[0]->reward;
            $task->sum = "In";
            $task->save();
        }

        // inserting USD Transaction
        $task = new transaction();
        $task->users_id = session('user')[0]->id;
        $task->status = "Approved";
        $task->type = "Exchange";
        $task->currency = "USD";
        $task->amount = $calc;
        $task->sum = "In";
        $task->save();
        return redirect()->back()->with('message', 'Task Completed Successfully');

        return $price;
    }



    public function tokenShare()
    {
        return view('dashboard.convert.tokenShare');
    }


    public function tokenShareReq(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric',
            'username' => 'required|alpha_num|min:5|max:30|exists:users',
        ]);

        if (balanceUSD() < $validated['amount']) {
            return redirect()->back()->withErrors('Insufficent Balance');
        }

        // checking if username is not same with logged in user
        if ($validated['username'] == session('user')[0]->username) {
            return redirect()->back()->withErrors('Invalid Username, Please Choose Another Account');
        }

        // inserting USD Transaction
        $task = new transaction();
        $task->users_id = session('user')[0]->id;
        $task->status = "Approved";
        $task->type = "Share";
        $task->currency = "USD";
        $task->amount = $validated['amount'];
        $task->sum = "Out";
        $task->save();

        // getting other user detail
        $query = users::where('username', $validated['username'])->first();

        // inserting balance into user
        $task = new transaction();
        $task->users_id = $query->id;
        $task->type = "Deposit";
        $task->status = "Approved";
        $task->sum = "In";
        $task->currency = "USD";
        $task->amount = $validated['amount'];
        $task->save();
        $name =  $query->fname . " " . $query->lname;
        return redirect()->back()->with('message', 'Token Shared with ' . $name . ' Successfully');
    }
}
