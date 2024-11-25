<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\reviews;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Review_Cotroller extends Controller
{
     public function getAll_reviews($id){
            $reviews = reviews::with('customers')->where('product_id',$id)->get();
        return response()->json(['cuccess' => 'Lấy đánh giá thành công.','data'=>$reviews], 200);
    } 
    
  public function handle_add_reviews(Request $request)
    {
        
    try{
         $validated = Validator::make($request->all(),[
        'customer_id' => 'required|numeric',
        'product_id' => 'required|numeric',
        'rating' => 'required|numeric',
        'content' => 'required|string',
        ], [
            'customer_id.required' => 'customer_id Phải Có',
            'customer_id.numeric' => 'customer_id phải là 1 số',
            'product_id.required' => 'product_id yêu cầu phải có',
            'product_id.numeric' => 'product_id phải là 1 số',
            'rating.required' => 'Đánh giá phải có',
            'rating.numeric' => 'Đánh giá phải là 1 số',
            'content.required' => 'content không được để trống',
            'content.string' => ' content phải là một Chuỗi',
        ]);
        // invalid format
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }
       
        // create orders
        $reviews =reviews::create([
             'customer_id' => $request->customer_id,
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'content' => $request->content,
           'images' => $request->images,
        ]);
        // return cuccess 
        return response()->json(['cuccess'=>'Thêm Thành Công', 'Thông tin Ngân Hàng' => $reviews], 201);
        }
   catch (QueryException $e) {
        // Catch database-related errors
        return response()->json(['Lỗi' => 'Cơ Sở dữ liệu lỗi ' . $e->getMessage()], 500);
    } catch (Exception $e) {
        // Catch any other exceptions
        return response()->json(['Lỗi' => '' . $e->getMessage()], 500);
    }
    } 
 
    
    public function handle_edit_reviews(Request $request, $id)
    {
        
         $validated = Validator::make($request->all(),[
        'customer_id' => 'required|numeric',
        'product_id' => 'required|numeric',
        'rating' => 'required|numeric',
        'content' => 'required|string',
        'images' => 'string'
        ], [
            'customer_id.required' => 'customer_id Phải Có',
            'customer_id.numeric' => 'customer_id phải là 1 số',
            'product_id.required' => 'product_id yêu cầu phải có',
            'product_id.numeric' => 'product_id phải là 1 số',
            'rating.required' => 'Đánh giá phải có',
            'rating.numeric' => 'Đánh giá phải là 1 số',
            'content.required' => 'content không được để trống',
            'content.string' => ' content phải là một Chuỗi',
            'images.string' => 'Ảnh phải là 1 chuỗi',
        ]);
        // invalid format
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }
       try{
         $reviews = reviews::find($id);
        if (!$reviews) {
            return response()->json(['Lỗi' => 'Không tìm thấy Đánh giá với ID: ' . $id], 404);
        }
        // Cập nhật bản ghi với dữ liệu đã xác thực
        $reviews->update([
             'customer_id' => $request->customer_id,
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'content' => $request->content,
           'images' => $request->images,
        ]);
        // Trả về phản hồi thành công
        return response()->json([
            'cuccess' => 'Cập Nhật Đánh giá Thành Công.',
            'data' => $reviews
        ], 200);
       }
       catch (QueryException $e) {
        // Catch database-related errors
        return response()->json(['Lỗi' => 'Cơ Sở dữ liệu lỗi ' . $e->getMessage()], 500);
    } catch (Exception $e) {
        // Catch any other exceptions
        return response()->json(['Lỗi' => '' . $e->getMessage()], 500);
    }
    } 
    
    
    
     public function handle_remove_reviews($id)
    {
        $address = reviews::find($id);
        if(!$address){
            return response()->json(['Lỗi' => 'Không tìm thấy Đánh giá với ID: '. $id], 404);
        }
        $address->delete();
        return response()->json(['cuccess' => 'Xoá Đánh giá thành công.']);
    }
}
