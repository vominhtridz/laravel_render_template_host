<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\banks;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Bank_Controller extends Controller
{
    
    public function get_banks($id){
       try{
         $banks = banks::where('customer_id',$id)->get();
        if($banks){
            return response()->json(['cuccess'=>'Lấy Ngân Hàng thành công.','data' => $banks], 200);
        }
        return response()->json(['Lỗi' => 'Ngân Hàng không tồn tại'], 404);
       }
         catch (QueryException $e) {
        // Catch database-related errors
        return response()->json(['Lỗi' => 'Cơ Sở dữ liệu lỗi ' . $e->getMessage()], 500);
    } catch (Exception $e) {
        // Catch any other exceptions
        return response()->json(['Lỗi' => '' . $e->getMessage()], 500);
    }
    } 
    
  public function handle_add_banks(Request $request)
    {
        
    try{
        $validated = Validator::make($request->all(),[
        'name' =>'required|string',
        'bank_name' =>'required|string',
        'branch_name' =>'required|string',
        'cccd' =>'required|string',
        'stk' =>'required|string',
        'customer_id' =>'required|numeric',
        'default' =>'boolean',
        ], [
            'name.required' => 'Tên ngân hàng không được để trống',
            'name.string' => 'Tên ngân hàng phải là một chuỗi',
            'bank_name.required' => 'Tên ngân hàng chủ thể không được để trống',
            'bank_name.string' => 'Tên ngân hàng chủ thể phải là một chuỗi',
            'branch_name.required' => 'Tên chi nhánh không được để trống',
            'branch_name.string' => 'Tên chi nhánh phải là một chuỗi',
            'cccd.required' => 'Số CCCD không được để trống',
            'cccd.string' => 'Số CCCD phải là một Chuỗi',
            'stk.required' => 'Số STK không được để trống',
            'stk.string' => 'Số STK phải là một Chuỗi',
            'customer_id.required' => 'ID khách hàng không được để trống',
            'customer_id.numeric' => 'ID khách hàng phải là một số',
        ]);
        // invalid format
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }
        // create orders
        $banks =banks::create([
             'name' => $request->name,
            'bank_name' => $request->bank_name,
            'branch_name' => $request->branch_name,
            'cccd' => $request->cccd,
           'stk' => $request->stk,
            'default' => (bool)$request->default,
            'customer_id' => $request->customer_id,
        ]);
        // return cuccess 
        return response()->json(['cuccess'=>'Thêm Ngân Hàng Thành Công', 'Thông tin Ngân Hàng' => $banks], 201);
        }
   catch (QueryException $e) {
        // Catch database-related errors
        return response()->json(['Lỗi' => 'Cơ Sở dữ liệu lỗi ' . $e->getMessage()], 500);
    } catch (Exception $e) {
        // Catch any other exceptions
        return response()->json(['Lỗi' => '' . $e->getMessage()], 500);
    }
    } 
 
    
    public function handle_edit_banks(Request $request, $id)
    {
        
         $validated = Validator::make($request->all(),[
        'name' =>'required|string',
        'bank_name' =>'required|string',
        'branch_name' =>'required|string',
        'cccd' =>'required|string',
        'stk' =>'required|string',
        'customer_id' =>'required|numeric',
        'default' =>'boolean',
        ], [
            'name.required' => 'Tên ngân hàng không được để trống',
            'name.string' => 'Tên ngân hàng phải là một chuỗi',
            'bank_name.required' => 'Tên ngân hàng chủ thể không được để trống',
            'bank_name.string' => 'Tên ngân hàng chủ thể phải là một chuỗi',
            'branch_name.required' => 'Tên chi nhánh không được để trống',
            'branch_name.string' => 'Tên chi nhánh phải là một chuỗi',
            'cccd.required' => 'Số CCCD không được để trống',
            'cccd.string' => 'Số CCCD phải là một Chuỗi',
            'stk.required' => 'Số STK không được để trống',
            'stk.string' => 'Số STK phải là một Chuỗi',
            'customer_id.required' => 'ID khách hàng không được để trống',
            'customer_id.numeric' => 'ID khách hàng phải là một số',
        ]);
        // invalid format
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }
       try{
         $bank = banks::find($id);
        if (!$bank) {
            return response()->json(['Lỗi' => 'Không tìm thấy ngân hàng với ID: ' . $id], 404);
        }
        // Cập nhật bản ghi với dữ liệu đã xác thực
        $bank->update([
            'name' => $request->name,
            'bank_name' => $request->bank_name,
            'branch_name' => $request->branch_name,
            'cccd' => $request->cccd,
            'stk' => $request->stk,
            'default' => (bool)$request->default,
            'customer_id' => $request->customer_id,
        ]);
        // Trả về phản hồi thành công
        return response()->json([
            'cuccess' => 'Cập Nhật Ngân Hàng Thành Công.',
            'data' => $bank
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
    
    
    
     public function handle_remove_banks($id)
    {
        $bank = banks::find($id);
        if(!$bank){
            return response()->json(['Lỗi' => 'Không tìm thấy ngân hàng với ID: '. $id], 404);
        }
        $bank->delete();
        return response()->json(['cuccess' => 'Xoá Ngân Hàng thành công.']);
    }
}
