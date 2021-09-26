<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\transaction;
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

        // getting out Reward from balance
        $task = new transaction();
        $task->users_id = session('user')[0]->id;
        $task->status = "Approved";
        $task->type = "Convert";
        $task->currency = "Reward";
        $task->amount = $adminQuery[0]->reward;
        $task->sum = "In";
        $task->save();

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



}
