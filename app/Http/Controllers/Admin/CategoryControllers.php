<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategoryControllers extends Controller
{
     // Handle Add Categories
    public function handleAddCategories(Request $request)
    {
   
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:Categories',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'slug' => 'required|string|max:255|unique:Categories',
        ]);
        $imageName = $request->file('image')->getClientOriginalName();
        $filePath = public_path('images/' . $imageName);
        if (!file_exists($filePath)) {
            $request->image->move(public_path('images'), $imageName);
        }
        $imagePath = 'images/' . $imageName;
        // Create a new category
        Categories::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'image' => $imagePath,
            'slug' => $validated['slug'],
        ]);
        // Return a response
        return redirect('/categories')->with('cuccess', 'Thêm danh mục thành công.');
    }
    // Handle Edit Categories
    public function handleEditCategories(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'slug' => 'required|string|max:255',
        ]);
        $NameAndSlugExits = Categories::where('id', '!=', $id)
            ->where('name', $request->name)
            ->where('slug', $request->slug)
            ->exists();
        if ($NameAndSlugExits) {
            return redirect()->back()->with('error', 'Tên danh mục hoặc slug đã tồn tại.');
        }
        // check if the image file exists then save it
        $category = Categories::find($id);
        $imageName = '';
        if (!file_exists(($category->image))) {
            $imageName = $request->file('image')->getClientOriginalName();
            $request->image->move(public_path('images'), $imageName);
        }
        if ($request->file('image')) {
            $imageName = $request->file('image')->getClientOriginalName();
        }
        // Create a new category
        $imagePath = 'images/' . $imageName;
        $newImagePath = $imagePath != 'images/' ? $imagePath : $category->image;
        $category->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'image' => $newImagePath,
            'slug' => $validated['slug'],
        ]);
        // Return a response
        return redirect('/categories')->with('cuccess', 'Cập nhật danh mục thành công.');
    }

    // Handle Remove Categories
    public function handleRemoveCategories($id)
    {
        // Find the category by ID
        $category = Categories::findOrFail($id);
        // Delete the category
        $category->delete();
        // Return a response
        return back()->with('cuccess', 'Xoá Danh Mục thành công.');
    }
     public function Add_category (){
        return view('components.categories.add_categories');
    }
       // Categories view
    public function All_category (){
        $categories = Categories::all();

        return view('components.categories.categories',compact('categories'));
    }
    public function EditCategory ($id){
        $category = Categories::find($id);
   
        if(!$category){
            return redirect('/categories')->with('error','Danh mục không tìm thấy!');
        }
        return view('components.categories.edit_categories',compact('category'));
    }
   
  
}
