<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\coupon;
use App\Models\transaction;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupon = coupon::paginate(20);
        return view('dashboard.coupon.index', [
            'coupons' => $coupon,
        ]);
    }

    public function couponActivate()
    {
        return view('dashboard.coupon.activate');
    }

    public function couponActiveReq(Request $request)
    {
        $validated = $request->validate([
            'coupon' => 'required|string|exists:coupons,value',
        ]);
        // fetching this coupon info
        $coupon = coupon::where('value', $validated['coupon'])->where('status', 'Open')->first();
        if ($coupon == "") {
            return redirect()->back()->withErrors('Invalid Coupon Code, or it may already been redeem');
        }

        // inserting balance into user
        $task = new transaction();
        $task->users_id = session('user')[0]->id;
        $task->type = "Coupon Code";
        $task->status = "Approved";
        $task->sum = "In";
        $task->currency = "Token";
        $task->amount = $coupon->amount;
        $task->save();

        $coupon->status = "Used";
        $coupon->save();
        return redirect()->back()->with('message', 'Coupon Activated Successfully');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.coupon.create');
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
            'redemption' => 'required|integer',
        ]);

        // getting current value of coupon
        $admin = admin::first();
        $coupons = 5000;
        $price = $admin->coupon;
        // checking if balance is not enough
        if (balanceUSD() < $price) {
            return redirect()->back()->withErrors('Insufficent Balance');
        }
        $redemption = $validated['redemption'];
        $calc = $coupons / $redemption;

        // inserting balance into user
        $task = new transaction();
        $task->users_id = session('user')[0]->id;
        $task->type = "Coupon Code";
        $task->status = "Approved";
        $task->sum = "Out";
        $task->currency = "USD";
        $task->amount = $price;
        $task->save();

        for ($i = 0; $i < $calc; $i++) {
            // generating Code for this loop
            regenrateCode:
            $value = random(40);
            $code = coupon::where('value', $value)->count();
            if ($code > 0) {
                goto regenrateCode;
            }
            $task = new coupon();
            $task->user_id = session('user')[0]->id;
            $task->amount = $redemption;
            $task->status = "Open";
            $task->value = $value;
            $task->save();
        }


        return redirect()->route('coupon.index')->with('message', 'Task Completed Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(coupon $coupon)
    {
        return view('dashboard.coupon.show', [
            'coupon' => $coupon,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(coupon $coupon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, coupon $coupon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(coupon $coupon)
    {
        $task = coupon::find($coupon->id);
        $task->delete();
        // return redirect()->route('pin.index')->with('message', 'Task Completed Successfully');
    }
}
