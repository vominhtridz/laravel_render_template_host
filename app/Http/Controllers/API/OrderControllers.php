<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\categories;
use App\Models\order_items;
use App\Models\order_status;
use App\Models\orders;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderControllers extends Controller
{
     public function handle_add_order(Request $request)
    {
    try{
        $validated = Validator::make($request->all(), [
    'customer_id' => 'required|numeric|exists:customers,customer_id', // customer_id phải tồn tại và là số
    'delivered_date' => 'required|date', // Ngày giao hàng phải hợp lệ
    'payment_date' => 'required|date', // Ngày thanh toán phải hợp lệ
    'order_date' => 'required|date', // Ngày đặt hàng phải hợp lệ
    'payment_status' => 'required|string', // Trạng thái thanh toán phải là chuỗi
 // Địa chỉ giao hàng không được để trống
    'shipping_method' => 'required|string', // Phương thức giao hàng phải là chuỗi
    'products' => 'required|array|min:1', // Phải có ít nhất một sản phẩm
    'products.*.product_id' => 'required|numeric|exists:products,id', // ID sản phẩm phải tồn tại và là số
    'products.*.quantity' => 'required|numeric|min:1', // Số lượng sản phẩm phải >= 1
    'products.*.price' => 'required|numeric|min:0', // Giá sản phẩm phải >= 0
    'products.*.total_price' => 'required|numeric|min:0', // Tổng giá phải >= 0
    'payment_method' => 'required|string', // Phương thức thanh toán phải hợp lệ
    'order_status' => 'required|string', // Trạng thái đơn hàng hợp lệ
    'total_amount' => 'required|numeric|min:0', // Tổng tiền phải >= 0
], [
    'customer_id.required' => 'Vui lòng nhập ID khách hàng.',
    'customer_id.exists' => 'ID khách hàng không tồn tại.',
    'customer_id.numeric' => 'ID khách hàng phải là một số.',
    'delivered_date.required' => 'Vui lòng nhập ngày giao hàng.',
    'delivered_date.date' => 'Ngày giao hàng phải có định dạng hợp lệ.',
    'payment_date.required' => 'Vui lòng nhập ngày thanh toán.',
    'payment_date.date' => 'Ngày thanh toán phải có định dạng hợp lệ.',
    'order_date.required' => 'Vui lòng nhập ngày đặt hàng.',
    'order_date.date' => 'Ngày đặt hàng phải có định dạng hợp lệ.',
    'payment_status.required' => 'Vui lòng nhập trạng thái thanh toán.',
   
    'shipping_method.required' => 'Vui lòng chọn phương thức giao hàng.',
    'products.required' => 'Vui lòng nhập sản phẩm.',
    'products.array' => 'Sản phẩm phải là một danh sách.',
    'products.min' => 'Vui lòng nhập ít nhất một sản phẩm.',
    'products.*.product_id.required' => 'product_id sản phẩm không được bỏ trống.',
    'products.*.product_id.exists' => 'product_id sản phẩm không tồn tại.',
    'products.*.quantity.required' => 'Số lượng sản phẩm không được bỏ trống.',
    'products.*.quantity.numeric' => 'Số lượng sản phẩm phải là một số.',
    'products.*.quantity.min' => 'Số lượng sản phẩm phải lớn hơn hoặc bằng 1.',
    'products.*.price.required' => 'Giá sản phẩm không được bỏ trống.',
    'products.*.price.numeric' => 'Giá sản phẩm phải là một số.',
    'products.*.price.min' => 'Giá sản phẩm phải lớn hơn hoặc bằng 0.',
    'products.*.total_price.required' => 'Tổng giá không được bỏ trống.',
    'products.*.total_price.numeric' => 'Tổng giá phải là một số.',
    'products.*.total_price.min' => 'Tổng giá phải lớn hơn hoặc bằng 0.',
    'payment_method.required' => 'Vui lòng chọn phương thức thanh toán.',
    'payment_method.in' => 'Phương thức thanh toán không hợp lệ.',
    'order_status.required' => 'Vui lòng chọn trạng thái đơn hàng.',
    'order_status.in' => 'Trạng thái đơn hàng không hợp lệ.',
    'total_amount.required' => 'Vui lòng nhập tổng số tiền.',
    'total_amount.numeric' => 'Tổng số tiền phải là một số.',
    'total_amount.min' => 'Tổng số tiền phải lớn hơn hoặc bằng 0.',
]);

        // invalid format
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }
        $deliveredDate = Carbon::parse($request->input('delivered_date'))->format('Y-m-d H:i:s');
        $paymentDate = Carbon::parse($request->input('payment_date'))->format('Y-m-d H:i:s');
        $orderDate = Carbon::parse($request->input('order_date'))->format('Y-m-d H:i:s');
        // create orders
        $order =orders::create(
            [
                'customer_id' => $request->customer_id,
                'delivered_date' => $deliveredDate,
                'shipped_date' => $request->shipped_date,
                'payment_date' => $paymentDate,
                'order_date' => $orderDate,   
                'payment_status' => $request->payment_status,
                'shipping_address' => $request->shipping_address,
                'shipping_method' => $request->shipping_method,
                'total_amount' => $request->total_amount,
                'notes' => $request->notes,
                'payment_method' => $request->payment_method,
                'order_status' => $request->order_status,
            ]
        );
      
        //create orders
        foreach($request->products as $product ){
            $SelectProduct = Product::where('id',$product['product_id'])->first();
             //If there isn't exists products available then remove the order and return response
            if(!$SelectProduct){
              orders::where('order_id', $order->id)->delete();
                return response()->json(['error' => 'Sản phẩm không tồn tại','orders'=>$order], 400);
            }
            // If there isn't enough products available then remove the order and return response
            if ($SelectProduct->quantity < $product['quantity']) {
              orders::where('order_id', $order->id)->delete();
                return response()->json(['error' => 'Không đủ sản phẩm trong kho', 'orders'=>$order], 400);
            }
            // decrement quantity of products
            $SelectProduct->decrement('quantity', $product['quantity']); // Giảm số lượng sản phẩm tồn kho
            // create order_items
            order_items::create(
                    [
                        'order_id' =>  $order->order_id,
                        'product_id' => $product['product_id'], // id sản phẩm
                        'quantity' => $product['quantity'], // Số lượng
                        'address_id' => $request->address_id, // Số lượng
                        'unit_price' => $SelectProduct['price'],// giá trị ban đầu của Sản Phẩm
                        'total_price'=> $SelectProduct['price'] *$product['quantity'] // Tổng giá trị
                    ]
            );
            $SelectProduct->save();
        }
        // create order new status
        order_status::create(
            [
                'order_id' =>  $order->order_id,
               'status' => $request->order_status,
            ]
        );
        // return cuccess 
        return response()->json(['success'=>'Mua hàng thành công', 'data' => $order], 201);
        }
   catch (QueryException $e) {
        // Catch database-related errors
        return response()->json(['Lỗi' => 'Cơ Sở dữ liệu lỗi ' . $e->getMessage()], 500);
    } catch (Exception $e) {
        // Catch any other exceptions
        return response()->json(['Lỗi' => '' . $e->getMessage()], 500);
    }
    } 
    public function FilterOrder(Request $request ){
        // Lấy trạng thái đơn hàng từ request
        
    $order_status = $request->input('order_status');  // `order_status` là giá trị bạn nhận từ form lọc
    if($request->order_status == 'tất cả')
    {
        $orders = orders::with('customers', 'order_items') //lấy tất cả
            ->get();
    }
    else {
        $orders = orders::with('customers', 'order_items')
            ->where('order_status', $order_status)  // Lọc theo trạng thái
            ->get();
    }
    // Trả lại view với danh sách đơn hàng và trạng thái lọc
    return view('Components.orders.orders', compact('orders'));
    }
     public function handle_cancelOrder($id){
        $order = orders::find($id);
        if (!$order) {
            return response()->json(['error' => 'Đơn hàng không tồn tại'], 404);
        }
        $order->order_status = 'cancelled';
        $order->save();
        return response()->json(['success' => 'Đơn hàng đã hủy thành công'], 200);
   
    }
    public function handle_edit_order(Request $request, $id)
    {
         $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'quantity' => 'required|numeric', 
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048', 
            'category' => 'required|string', 
            'color'=>'required|string',
        ]);
        $product = Product::findOrFail($id);
        $image = '';
        if($request->hasFile('image')){
        $imagePath = time() .'.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path('images'),$imagePath );
        $image = 'images/' . $imagePath;
        }
        $selectImage = empty($image) ? $product->image: $image;
        $product->update([
        'name'=> $validated['name'],
        'price'=> $validated['price'],
        'description'=> $validated['description'],
        'quantity'=> $validated['quantity'],
        'image'=> $selectImage,
        'category_id'=> categories::where('name', $request->category)->first()?->id,
        'color'=> $validated['color'],
        ]);
        // Return a response
        return redirect('/products')->with('cuccess', 'Cập nhật Sản Phẩm Thành Công.');
    }
    
     public function UpdateStatusOrder(Request $request, $id)
    {
        $order = orders::find($id);

    if (!$order) {
        return response()->json(['message' => 'Đơn hàng không tồn tại!'], 404);
    }
    // Cập nhật trạng thái đơn hàng
    $order->order_status = $request->status;
    $order->save();

    return response()->json(['message' => 'Cập nhật trạng thái thành công!', 'cuccess' =>'Cập nhật Thành Công'], 200);
    }
    public function SearchOrder(Request $request){
        $searchFollow = $request->input('searchfollow');
        $searchTerm = $request->input('name');
        // Initialize query builder
        $query = orders::query();

        // Filter based on selected search criteria
        if ($searchFollow == 'Tên') {
            $query->where('order_id', 'like', '%' . $searchTerm . '%'); // Search by order ID
        } elseif ($searchFollow == 'mã sản phẩm') {
            // Assuming orders have a related products table. Update as per your database structure
            $query->whereHas('products', function ($q) use ($searchTerm) {
                $q->where('product_name', 'like', '%' . $searchTerm . '%');
            });
        } elseif ($searchFollow == 'thương hiệu') {
            $query->where('order_status', 'like', '%' . $searchTerm . '%'); // Search by order status
        }

        // Get the filtered orders
        $orders = $query->get();

        // If the request is AJAX, return a partial view with the search results
        if ($request->ajax()) {
            return view('Components.orders.tracking_orders', compact('orders'));  // Return a partial view with the filtered orders
        }

        // For non-AJAX requests (regular form submission)
        return view('Components.orders.tracking_orders', compact('orders'));
    }
    
     public function getOrderByCustomer_id($id)
    {
        try{
            $orders = orders::with(['customers','order_items.address'])->where('customer_id',$id)->get();
            return response()->json(['success'=>true, 'data' => $orders], 200);
        }
         catch (QueryException $e) {
        // Catch database-related errors
        return response()->json(['Lỗi' => 'Cơ Sở dữ liệu lỗi ' . $e->getMessage()], 500);
    } catch (Exception $e) {
        // Catch any other exceptions
        return response()->json(['Lỗi' => '' . $e->getMessage()], 500);
    }
    }
     public function handle_remove_order($id)
    {
        try{
            $order = orders::findOrFail($id);
        
        $order->delete();
        return redirect('/orders')->with('cuccess', 'Xoá thành công.');
        }
         catch (QueryException $e) {
        // Catch database-related errors
        return response()->json(['Lỗi' => 'Cơ Sở dữ liệu lỗi ' . $e->getMessage()], 500);
    } catch (Exception $e) {
        // Catch any other exceptions
        return response()->json(['Lỗi' => '' . $e->getMessage()], 500);
    }
    }
}
