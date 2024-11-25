<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\reviews;
use Illuminate\Http\Request;

class ReviewControllers extends Controller
{
      public function All_review (){
    $reviews = reviews::with('customers')->get();
        return view('reviews',compact('reviews'));
    }
}
