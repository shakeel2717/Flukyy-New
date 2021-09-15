<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\Support;
use App\Models\transaction;
use App\Models\users;
use Illuminate\Http\Request;

class adminDashboard extends Controller
{
    public function index()
    {

        return view('admin.dashboard.index', [
            'totalUsers' => users::get(),
            'adminQuery' => admin::first(),
        ]);
    }

    public function allUsers()
    {
        return view('admin.dashboard.allUsers', [
            'allUsers' => users::get(),
        ]);
    }

    public function allSupports()
    {
        return view('admin.dashboard.allSupports', [
            'allSupports' => Support::get(),
        ]);
    }

    public function insertBalance()
    {
        return view('admin.dashboard.insertBalance');
    }


    public function insertBalanceReq(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|min:4|max:30|exists:users',
            'currency' => 'required',
            'amount' => 'required|numeric',
        ]);
        // inserting balance into user
        $task = new transaction();
        $task->users_id = session('user')[0]->id;
        $task->type = "Deposit";
        $task->status = "Approved";
        $task->sum = "In";
        $task->currency = $validated['currency'];
        $task->amount = $validated['amount'];
        $task->save();
        return redirect()->back()->with('message', 'Balance Added into User Accont Successfully');
    }
}
