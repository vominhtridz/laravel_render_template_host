<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\address;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Address_Controller extends Controller
{
     public function get_address($id){
       try{
         $address = address::where('customer_id',$id)->get();
        if($address){
            return response()->json(['cuccess'=>'Lấy địa chỉ thành công.','data' => $address], 200);
        }
        return response()->json(['Lỗi' => 'Địa Chỉ không tồn tại'], 404);
       }
         catch (QueryException $e) {
        // Catch database-related errors
        return response()->json(['Lỗi' => 'Cơ Sở dữ liệu lỗi ' . $e->getMessage()], 500);
    } catch (Exception $e) {
        // Catch any other exceptions
        return response()->json(['Lỗi' => '' . $e->getMessage()], 500);
    }
    } 
    
  public function handle_add_address(Request $request)
    {
        
    try{
         $validated = Validator::make($request->all(),[
        'name' =>'required|string',
        'phonenumber' =>'required|string',
        'detail_address' =>'required|string',
        'city_address' =>'required|string',
        'postal_code' =>'required|string',
        'customer_id' =>'required|numeric',
        'default' =>'boolean',
        ], [
            'name.required' => 'Tên không được để trống',
            'name.string' => 'Tên phải là một chuỗi',
            'phonenumber.required' => 'Số điện thoại chủ thể không được để trống',
            'phonenumber.string' => 'Số điện thoại chủ thể phải là một chuỗi',
            'detail_address.required' => 'địa chỉ chi tiết không được để trống',
            'detail_address.string' => 'địa chỉ chi tiết phải là một chuỗi',
            'city_address.required' => 'Số city_address không được để trống',
            'city_address.string' => 'Số city_address phải là một Chuỗi',
            'postal_code.required' => 'Số postal_code không được để trống',
            'postal_code.string' => 'Số postal_code phải là một Chuỗi',
            'customer_id.required' => 'ID khách hàng không được để trống',
            'customer_id.numeric' => 'ID khách hàng phải là một số',
        ]);
        // invalid format
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }

            $checkExitsDefault = address::where('default', 1);
            if($checkExitsDefault->count() > 0 && $request->default == 1){
                $checkExitsDefault->update(['default' => 0]);
            }
        // create orders
        $address =address::create([
             'name' => $request->name,
            'phonenumber' => $request->phonenumber,
            'detail_address' => $request->detail_address,
            'city_address' => $request->city_address,
           'postal_code' => $request->postal_code,
            'default' => (bool)$request->default,
            'customer_id' => $request->customer_id,
        ]);
        // return cuccess 
        return response()->json(['cuccess'=>'Thêm Thành Công', 'Thông tin Ngân Hàng' => $address], 201);
        }
   catch (QueryException $e) {
        // Catch database-related errors
        return response()->json(['Lỗi' => 'Cơ Sở dữ liệu lỗi ' . $e->getMessage()], 500);
    } catch (Exception $e) {
        // Catch any other exceptions
        return response()->json(['Lỗi' => '' . $e->getMessage()], 500);
    }
    } 
 
    
    public function handle_edit_address(Request $request, $id)
    {
        
         $validated = Validator::make($request->all(),[
        'name' =>'required|string',
        'phonenumber' =>'required|string',
        'detail_address' =>'required|string',
        'city_address' =>'required|string',
        'postal_code' =>'required|string',
        'customer_id' =>'required|numeric',
        'default' =>'boolean',
        ], [
            'name.required' => 'Tên không được để trống',
            'name.string' => 'Tên phải là một chuỗi',
            'phonenumber.required' => 'Tên chủ thể không được để trống',
            'phonenumber.string' => 'Tên chủ thể phải là một chuỗi',
            'detail_address.required' => 'Tên chi nhánh không được để trống',
            'detail_address.string' => 'Tên chi nhánh phải là một chuỗi',
            'city_address.required' => 'Số city_address không được để trống',
            'city_address.string' => 'Số city_address phải là một Chuỗi',
            'postal_code.required' => 'Số postal_code không được để trống',
            'postal_code.string' => 'Số postal_code phải là một Chuỗi',
            'customer_id.required' => 'ID khách hàng không được để trống',
            'customer_id.numeric' => 'ID khách hàng phải là một số',
        ]);
        // invalid format
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }
       try{
         $checkExitsDefault = address::where('default', 1);
        if($checkExitsDefault->count() > 0 && $request->default == 1){
            $checkExitsDefault->update(['default' => 0]);
        }
         $address = address::find($id);
        if (!$address) {
            return response()->json(['Lỗi' => 'Không tìm thấy địa chỉ với ID: ' . $id], 404);
        }
        // Cập nhật bản ghi với dữ liệu đã xác thực
        $address->update([
            'name' => $request->name,
            'phonenumber' => $request->phonenumber,
            'detail_address' => $request->detail_address,
            'city_address' => $request->city_address,
           'postal_code' => $request->postal_code,
            'default' => (bool)$request->default,
            'customer_id' => $request->customer_id,
        ]);
        // Trả về phản hồi thành công
        return response()->json([
            'cuccess' => 'Cập Nhật Địa Chỉ Thành Công.',
            'data' => $address
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
    
    
    
     public function handle_remove_address($id)
    {
        $address = address::find($id);
        if(!$address){
            return response()->json(['Lỗi' => 'Không tìm thấy địa chỉ với ID: '. $id], 404);
        }
        $address->delete();
        return response()->json(['cuccess' => 'Xoá địa chỉ thành công.']);
    }
}
