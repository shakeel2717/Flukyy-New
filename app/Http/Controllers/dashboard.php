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
        $Activecontest = contest::where('status','Active')->first();
        return view('dashboard.index',[
            'Activecontest' => $Activecontest,
        ]);
    }

}
