<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\contest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class dashboard extends Controller
{
    public function index()
    {
        $adminQuery = admin::first();
        $Activecontest = contest::where('status','Active')->first();
        return view('dashboard.index',[
            'adminQuery' => $adminQuery,
            'Activecontest' => $Activecontest,
        ]);
    }

}
