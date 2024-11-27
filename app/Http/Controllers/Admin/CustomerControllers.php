<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\customers;
use Illuminate\Http\Request;

class CustomerControllers extends Controller
{
    public function List_Support_Customer (){
        return view('Components.customers.support_customers');
    }
    
      public function getAll_Customer (){
        $customers = customers::with('orders', 'banks')->get();
        return view('Components.customers.customers',compact('customers'));
    }
     public function support_messages (){
        return view('Components.customers.manage_messages');
    }
     public function InforCustomers ($id){
        $customer = customers::find($id);
        if($customer){
            return view('Components.customers.infor_customers',compact('customer'));
        }
        return redirect()->back()->with('error','không tìm thấy khách hàng.');
    }
    public function handleAddcustomers(Request $request){
       $validated = $request->validate([
        'name'=> 'required|string|',
        'image'=> 'required|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
        'link_url'=> 'required|string',
        'start_date'=> 'required|date',
        'end_date'=> 'required|date',
        'status'=> 'required|string',
        'description'=> 'required|string',
        ],[
            'name.required' => 'Tên banner không được để trống.',
            'name.string' => 'Tên banner phải là chuỗi.',
            'image.required' => 'Hình ảnh banner không được để trống.',
            'image.image' => 'Hình ảnh phải là một ảnh.',
            'image.mimes' => 'Hình ảnh phải có đuôi jpeg, png, jpg, gif, webp, svg.',
            'image.max' => 'Hình ảnh phải nhiều hơn 2MB.',
            'link_url.required' => 'Link URL banner không được để trống.',
            'link_url.string' => 'Link URL banner phải là chuỗi.',
        ]);
        $userid = $request->user()->id;
        $imageName = $request->file('image')->getClientOriginalName();
        $filePath = public_path('images/' . $imageName);
        if (!file_exists($filePath)) {
            $request->image->move(public_path('images'), $imageName);
        }
        $imagePath = 'images/' . $imageName;
        // Create a new category
        customers::create([
        'name'=> $validated['name'],
        'image_url'=> $imagePath,
        'link_url'=> $validated['link_url'],
        'start_date'=> $validated['start_date'],
        'end_date'=> $validated['end_date'],
        'status'=> $validated['status'],
        'description'=> $validated['description'],
        'created_by'=> $userid,
        'updated_by'=> $userid,
        ]);
        // Return a response
        return redirect('/banners')->with('cuccess', 'Thêm banner thành công.');
}
public function handleEditcustomers(Request $request,$id){
       $validated = $request->validate([
        'name'=> 'required|string|',
        'image'=> 'image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
        'link_url'=> 'required|string',
        'start_date'=> 'required|date',
        'end_date'=> 'required|date',
        'status'=> 'required|string',
        'description'=> 'required|string',
        ],[
            'name.required' => 'Tên banner không được để trống.',
            'name.string' => 'Tên banner phải là chuỗi.',
            'image.image' => 'Hình ảnh phải là một ảnh.',
            'image.mimes' => 'Hình ảnh phải có đuôi jpeg, png, jpg, gif, webp, svg.',
            'image.max' => 'Hình ảnh phải nhiều hơn 2MB.',
            'link_url.required' => 'Link URL banner không được để trống.',
            'link_url.string' => 'Link URL banner phải là chuỗi.',
        ]);
        $userid = $request->user()->id;
        // check if the image file exists then save it
        $banner = customers::find($id);
        $imageName = '';
        if (!file_exists(($banner->image_url))) {
            $imageName = $request->file('image')->getClientOriginalName();
            $request->image->move(public_path('images'), $imageName);
        }
        if ($request->file('image')) {
            $imageName = $request->file('image')->getClientOriginalName();
        }
        // Create a new category
        $imagePath = 'images/' . $imageName;
        $newImagePath = $imagePath != 'images/' ? $imagePath : $banner->image_url;
       $banner->update([
        'name'=> $validated['name'],
        'image_url'=> $newImagePath,
        'link_url'=> $validated['link_url'],
        'start_date'=> $validated['start_date'],
        'end_date'=> $validated['end_date'],
        'status'=> $validated['status'],
        'description'=> $validated['description'],
        'updated_by'=> $userid,
        ]);
        // Return a response
        return redirect('/customers/getAll')->with('cuccess', 'Cập nhật Banner Thành Côg.');
}
public function handleRemovecustomers($id){
     // Find the customers by ID
        $customers = customers::findOrFail($id);
        // Delete the customers
        $customers->delete();
        // Return a response
        return back()->with('cuccess', 'Xoá Khách Thành Công.');
}

}

