<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductControllers extends Controller
{
    // search Prouducts
    public function handleSearchProduct(Request $request){
        $products = null;
    if($request->name){
        $products = Product::where('name', 'LIKE', '%'.$request->name.'%')->paginate(20);
        
    }
    else if($request->code){
        $products = Product::where('id', 'LIKE', '%'.$request->code.'%')->paginate(20);
    }
    else if($request->trademark){
        $products = Product::where('trademark', 'LIKE', '%'.$request->trademark.'%')->paginate(20);
    }
    if($products->isEmpty()){
        return back()->with('products', $products = null);
    }
        return back()->with('products', $products );

    
}
    public function handleAddProduct(Request $request)
    {
       
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'quantity' => 'required|numeric', 
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048', 
            'category' => 'required|string', 
            'color'=>'required|string',
        ]);
        $imagePath = time() .'.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path('images'),$imagePath );
        $image = 'images/' . $imagePath;
        Product::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'description' => $validated['description'],
            'quantity' => $validated['quantity'],
            'image' => $image,
            'category_id' => Categories::where('name', $validated['category'])->first()->id,
            'color' => $validated['color'],
        ]);

        return redirect('/products')->with('cuccess', 'Thêm Sản Phẩm Thành Công.');
    }
  public function handleEditProduct(Request $request, $id)
    {
        // Validate the incoming request data
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
        'category_id'=> Categories::where('name', $request->category)->first()?->id,
        'color'=> $validated['color'],
        ]);
        // Return a response
        return redirect('/products')->with('cuccess', 'Cập nhật Sản Phẩm Thành Công.');
    }

    // Handle Remove Product
    public function handleRemoveProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return back()->with('cuccess' , 'Xoá Sản Phẩm thành công.');
    }

    // view Search product page
    public function SearchProduct (){
        $categories = Categories::all();
            return view('Components.products.search_products',compact('categories'));    
    }
    // view All product page
     public function All_Product (){
        $products = Product::all();
        return view('Components.products.products',compact('products'));
    }
    // add Product
    public function Add_Product (){
        $categories = Categories::all();
        return view('Components.products.add_products',compact('categories'));
    }
    // update product
     public function edit_product ($id){
        $product = Product::find($id);
       $categories = Categories::all();
        return view('Components.products.edit_product',compact('product','categories'));
    }
}
