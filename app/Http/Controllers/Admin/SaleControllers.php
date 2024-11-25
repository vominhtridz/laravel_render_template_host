<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SaleControllers extends Controller
{
     public function Promotion (){
        return view('components.products.promotions');
    }
   public function Edit_Promotion (){
        return view('components.products.edit_promotion');

    }
  public function Add_Promotion (){
        return view('components.products.add_promotions');
    }
}
