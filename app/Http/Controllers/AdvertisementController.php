<?php

namespace App\Http\Controllers;

use App\Models\advertisement;
use App\Models\surfing;
use App\Models\transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.advertisement.index', [
            'advertisements' => advertisement::where('status', 1)->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function show(advertisement $advertisement)
    {
        // checking if this ads is already watched
        $security = surfing::where('user_id',session('user')[0]->id)->where('ads_id',$advertisement->id)->whereDate('created_at', Carbon::today())->get();
        if (count($security) > 0) {
            return redirect()->back()->withErrors('Sorry, You are Already Watched this Ads, Please wait or Watch another ads.');
        }
        // inserting Token into Transaction
        $task = new surfing();
        $task->ads_id = $advertisement->id;
        $task->user_id = session('user')[0]->id;
        $task->save();


        // Inserting Token balance
        $task = new transaction();
        $task->users_id = session('user')[0]->id;
        $task->status = "Approved";
        $task->type = "Advertisement";
        $task->currency = "Token";
        $task->amount = $advertisement->price;
        $task->sum = "In";
        $task->save();
        return view('dashboard.advertisement.show', [
            'advertisement' => $advertisement,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function edit(advertisement $advertisement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, advertisement $advertisement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function destroy(advertisement $advertisement)
    {
        //
    }
}
