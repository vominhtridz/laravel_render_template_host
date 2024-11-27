<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\customers;
use App\Models\order_items;
use App\Models\orders;
use App\Models\Product;
use App\Models\User;

class AdminController extends Controller
{
    //  Get view path
    public function Home (){
        // Get all orders
        $orders = orders::with(['customers','order_items.address'])->get();
        $products = Product::all();
        $customers = customers::with(['orders','banks'])->get();
        $orders_news = orders::with(['customers', 'order_items.address'])
    ->orderBy('order_date', 'desc') // Thay 'order_date' bằng tên cột thời gian của bạn
    ->take(5)
    ->get();

        $users = User::all();
        // Return view with orders data
        return view('home', compact('orders','products','customers','users','orders_news'));
  
    }
    
    
 public function AllOrders(){
        $orders = orders::with(['customers','order_items.address'])->get();
        
    return view('Components.orders.orders',compact('orders'));
 }
 public function view_detail_order($order_id){
        $order = orders::where('order_id', $order_id)->first();
        $order_items = order_items::with('products')->where('order_id', $order_id)->get();
        $customer = customers::where('customer_id', $order->customer_id)->first();
        $total_price = 0;
        foreach($order_items as $item){
            $total_price += $item->total_price;
        }
   return view('Components.orders.detail_order',compact('total_price','order','order_items','customer'));
 }

 public function tracking_Oders(){
     $orders = orders::with(['customers','order_items'])->get();
     return   view('Components.orders.tracking_orders' ,compact('orders'));
 }
}
