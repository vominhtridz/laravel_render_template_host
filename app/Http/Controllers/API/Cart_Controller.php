<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\cart;
use App\Models\Product;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Cart_Controller extends Controller
{
      public function getAll_cart($customer_id){
            try{
                $cartItems = Cart::with('products')->where('customer_id', $customer_id)->get();
                return response()->json(['success' => 'Lấy Giỏ Hàng thành công.','data'=>$cartItems], 200);
            }
            catch (QueryException $e) {
        // Catch database-related errors
        return response()->json(['Lỗi' => 'Cơ Sở dữ liệu lỗi ' . $e->getMessage()], 500);
    } catch (Exception $e) {
        // Catch any other exceptions
        return response()->json(['Lỗi' => '' . $e->getMessage()], 500);
    }
    } 
    
  public function handle_add_cart(Request $request)
    {
        try {
            $validated = Validator::make($request->all(), [
                'quantity' => 'required|integer|min:1',
                'discount' => 'nullable|numeric|min:0',
                'customer_id' => 'required|exists:customers,customer_id',
                'product_id' => 'required|exists:products,id',
                'session_id' => 'nullable|string'
            ], [
                'quantity.required' => 'Số Lượng Phải Có',
                'quantity.numeric' => 'Số Lượng phải là 1 số',
                'discount.numeric' => 'Giảm giá Hàng phải là 1 số',
                'customer_id.required' => 'customer_id không được để trống',
                'customer_id.numeric' => ' customer_id phải là một Số',
            ]);
            // invalid format
            if ($validated->fails()) {
                return response()->json($validated->errors(), 400);
            }
            $checkCartExits = cart::with('customers', 'products')
                ->where('product_id', $request->product_id)
                ->where('customer_id', $request->customer_id)
                ->first();

            // Nếu giỏ hàng đã tồn tại
            if ($checkCartExits) {
                // Kiểm tra tồn kho
                $checkInventory = $checkCartExits->quantity + $request->quantity > $checkCartExits->products->quantity;
                if ($checkInventory) {
                    return response()->json(['error' => 'Hàng Hóa này vượt quá số lượng còn hàng.'], 400);
                }
                // Cập nhật giỏ hàng
                $initPrice = $checkCartExits->products->price; // Giá Sản Phẩm ban đầu
                $oldQuantity = $checkCartExits->quantity; // Số lượng cũ
                $newQuantity = $oldQuantity + $request->quantity;// Số lượng cũ + số lượng mới
                // ((Số lượng cũ + số lượng mới) * Số tiền sản phẩm ban đầu) + Tiền Giảm giá = tổng số tiền mới.
                $total_price = ($initPrice * ($oldQuantity + $request->quantity));

                $checkCartExits->update([
                    'quantity' => $newQuantity,
                    'total_price' => $total_price,
                ]);

                return response()->json(['success' => 'Cập Nhật Thành Công', 'cart' => $checkCartExits], 200);
            }
            // Nếu giỏ hàng chưa tồn tại, kiểm tra tồn kho trực tiếp từ sản phẩm
            $product = Product::find($request->product_id);
            if (!$product || $request->quantity > $product->quantity) {
                return response()->json(['error' => 'Hàng Hóa này vượt quá số lượng còn hàng.'], 400);
            }
            $total_price = ($product->price * $request->quantity); // Số tiền gốc * Số lượng +  Giảm giá = tổng số tiền
            // Tạo mới giỏ hàng
            $cart = cart::create([
                'quantity' => $request->quantity,
                'price' => $product->price,
                'discount' => $request->discount,
                'customer_id' => $request->customer_id,
                'product_id' => $request->product_id,
                'total_price' => $total_price,
                'session_id' => $request->session_id,
            ]);
            return response()->json(['success' => 'Thêm Thành Công', 'cart' => $cart], 201);
        }
   catch (QueryException $e) {
        // Catch database-related errors
        return response()->json(['Lỗi' => 'Cơ Sở dữ liệu lỗi ' . $e->getMessage()], 500);
    } catch (Exception $e) {
        // Catch any other exceptions
        return response()->json(['Lỗi' => '' . $e->getMessage()], 500);
    }
    } 
 
    
    public function handle_edit_cart(Request $request, $id)
    {
         $validated = Validator::make($request->all(),[
        'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'customer_id' => 'required|exists:customers,customer_id',
            'product_id' => 'required|exists:products,id',
            'total_price' => 'required|numeric|min:0',
            'session_id' => 'nullable|string'
        ], [
            'quantity.required' => 'Số Lượng Phải Có',
            'quantity.numeric' => 'Số Lượng phải là 1 số',
            'price.required' => 'Giá yêu cầu phải có',
            'price.numeric' => 'price phải là 1 số',
            'discount.required' => 'Giảm giá Hàng phải có',
            'discount.numeric' => 'Giảm giá Hàng phải là 1 số',
            'customer_id.required' => 'customer_id không được để trống',
            'customer_id.numeric' => ' customer_id phải là một Số',
            'total_price.numeric' => 'Tổng giá phải là 1 số',
        ]);
        // invalid format
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }
       try{
         $cart = cart::find($id);
        if (!$cart) {
            return response()->json(['Lỗi' => 'Không tìm thấy Giỏ Hàng với ID: ' . $id], 404);
        }
        // Cập nhật bản ghi với dữ liệu đã xác thực
        $cart->update([
        'quantity'=> $request->quantity,
        'price'=> $request->price,
        'discount'=> $request->discount,
        'customer_id'=> $request->customer_id,
        'product_id'=> $request->product_id,
        'total_price'=> $request->total_price,
        'session_id'=> $request->session_id,
        ]);
        // Trả về phản hồi thành công
        return response()->json([
            'success' => 'Cập Nhật Giỏ Hàng Thành Công.',
            'data' => $cart
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
    
    
      public function handle_removeAll_cart()
    {
       cart::query()->delete();
        return response()->json(['success' => 'Xoá Giỏ Hàng thành công.']);
    }
     public function handle_remove_cart($id)
    {
        $cart = cart::find($id);
        if(!$cart){
            return response()->json(['Lỗi' => 'Không tìm thấy Giỏ Hàng với ID: '. $id], 404);
        }
        $cart->delete();
        return response()->json(['success' => 'Xoá Giỏ Hàng thành công.']);
    }
}
