<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalesReportYearsController extends Controller
{
    public function index()
    {
        return view('sales-report-years');
    }
}
