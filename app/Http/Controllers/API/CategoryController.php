<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\banners;
use App\Models\Categories;
use App\Models\Product;
use Illuminate\Database\QueryException;

class CategoryController extends Controller
{
    public function All_category(){
        $categories = Categories::all();
        if(!$categories){
            return response()->json(['message' => 'không tìm thấy danh mục'],404);
        }
        return response()->json($categories,200);
    }
    public function getAllProductById($id){
       try{
         $products = Product::whereHas('categories', function ($query) use ($id) {
            $query->where('category_id', $id);
        })->get();
        if(!$products){
            return response()->json(['message' => 'không tìm thấy Sản Phẩm'],404);
        }
        return response()->json($products,200);
       }
       catch(QueryException $e){
         return response()->json(['error' => $e],500);
       }
    }
     public function Get_Productby_category($slug){
       try{
         $products = Product::whereHas('categories', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })->get();
        if(!$products){
            return response()->json(['message' => 'không tìm thấy Sản Phẩm'],404);
        }
        return response()->json($products,200);
       }
       catch(QueryException $e){
         return response()->json(['error' => $e],500);
       }
    }
      public function All_banner(){
        $categories = Banners::where('status', 'hoạt động')->get();
        
        if(!$categories){
            return response()->json(['message' => 'không tìm thấy danh mục'],404);
        }
        return response()->json($categories,200);
    }
}
