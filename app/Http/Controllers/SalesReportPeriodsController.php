<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalesReportPeriodsController extends Controller
{
    public function index()
    {
        return view('sales-report-periods');
    }
}
