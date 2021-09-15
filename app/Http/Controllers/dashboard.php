<?php

namespace App\Http\Controllers;

use App\Models\admin;
use Carbon\Carbon;
use Illuminate\Http\Request;

class dashboard extends Controller
{
    public function index()
    {
        $adminQuery = admin::first();
        return view('dashboard.index',[
            'adminQuery' => $adminQuery,
        ]);
    }

}
