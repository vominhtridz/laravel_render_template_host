<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Product;
use App\Models\promotion;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Promotion_Controller extends Controller
{
    public function handleAddpromotion(Request $request)
    {
        // Validate the incoming request data
        try{
            $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'promotion_type' => 'required|string', // Loại khuyến mãi
        'applicable_to' => 'required|in:category,product,both', // Áp dụng cho sản phẩm hoặc danh mục
        'used_count' => 'nullable|integer|min:0', // Số lần đã sử dụng
        'start_date' => 'required|date|before_or_equal:end_date', // Ngày bắt đầu <= ngày kết thúc
        'end_date' => 'required|date|after_or_equal:start_date', // Ngày kết thúc >= ngày bắt đầu
        'discount_value' => 'required|numeric|min:1|max:100', // Giá trị giảm giá (giả định % tối đa là 100)
        'status' => 'string', // Trạng thái khuyến mãi
        'category_id' => 'required|exists:categories,id', // Nếu chọn danh mục, phải tồn tại trong bảng categories
        'product_id' => 'required|exists:products,id', // Trạng thái chỉ có thể là 'active' hoặc 'inactive'
        ]);
        // Create a new promotion
        promotion::create($validated);
        // Return a response
        return redirect('/promotion')->with('cuccess', 'Thêm Khuyến Mãi thành công.');
        } catch (QueryException $e) {
        // Catch database-related errors
        return response()->json(['Lỗi' => 'Cơ Sở dữ liệu lỗi ' . $e->getMessage()], 500);
    } catch (Exception $e) {
        // Catch any other exceptions
        return response()->json(['Lỗi' => '' . $e->getMessage()], 500);
    }
    }
    // Handle Edit tax
    public function handleEditpromotion(Request $request, $id)
    {
       $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'promotion_type' => 'required|string', // Loại khuyến mãi
        'applicable_to' => 'required|in:category,product,both', // Áp dụng cho sản phẩm hoặc danh mục
        'used_count' => 'nullable|integer|min:0', // Số lần đã sử dụng
        'start_date' => 'required|date|before_or_equal:end_date', // Ngày bắt đầu <= ngày kết thúc
        'end_date' => 'required|date|after_or_equal:start_date', // Ngày kết thúc >= ngày bắt đầu
        'discount_value' => 'required|numeric|min:1|max:100', // Giá trị giảm giá (giả định % tối đa là 100)
        'status' => 'string', // Trạng thái khuyến mãi
        'category_id' => 'required|exists:categories,id', // Nếu chọn danh mục, phải tồn tại trong bảng categories
        'product_id' => 'required|exists:products,id', // Trạng thái chỉ có thể là 'active' hoặc 'inactive'
        ]);
        $promotion = promotion::find($id);
        // Create a new promotion
        $promotion->update($validated);
        // Return a response
        return redirect('/promotion')->with('cuccess', 'Cập Nhật Khuyến Mãi thành công.');
    }

    // Handle Remove promotion
    public function handleRemovepromotion($id)
    {
        // Find the promotion by ID
        $promotion = promotion::findOrFail($id);
        // Delete the promotion
        $promotion->delete();
        // Return a response
        return back()->with('cuccess', 'Xoá Khuyến Mãi thành công.');
    }
     public function Promotion (){
        try{
$promotions = Promotion::with('categories', 'products')->get();
                return view('Components.products.promotions',compact('promotions'));
        }
          catch (QueryException $e) {
        // Catch database-related errors
        return response()->json(['Lỗi' => 'Cơ Sở dữ liệu lỗi ' . $e->getMessage()], 500);
    } catch (Exception $e) {
        // Catch any other exceptions
        return response()->json(['Lỗi' => '' . $e->getMessage()], 500);
    }
    
    }
   public function Edit_Promotion ($id){
    $promotion = promotion::with('categories','products')->where('id',$id)->first();
     $categories = categories::all();
    $products = Product::all();
        return view('Components.products.edit_promotion',compact('promotion','products','categories'));
    }
  public function Add_Promotion (){
    $categories = categories::all();
    $products = Product::all();

        return view('Components.products.add_promotions', compact('categories', 'products'));
    }
}
