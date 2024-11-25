<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportControllers extends Controller
{
    public function Revenue (){
        return view('report_revenue');
    }
    
}
