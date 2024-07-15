<?php

namespace App\Http\Controllers;

use App\Models\DailyRecord;

class DailyRecordController extends Controller
{
    public function index()
    {
        $records = DailyRecord::all();
        return view('dailyrecords.index', compact('records'));
    }
}
