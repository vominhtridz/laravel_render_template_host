<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\roles;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class UserControllers extends Controller
{
 public function handleEditUser(Request $request,$id)
    {
 // Validate the incoming request data
        try{
          $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'role' => 'required|string', // Loại Người Dùng
        'status' => 'string', // Loại Người Dùng
        ]);
        // Create a new User
        $role = roles::where('name', $request->role)->first();
        if(!$role){
        return back()->with('error', 'Không có Vai Trò Này.');
        }
        $User = User::find($id);
      $User->roles()->attach($role->id);
        // Create a new User
        $User->update([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'status' => $validated['status'],
        ]);
        // Return a response
        return redirect('/users')->with('cuccess', 'Cập Nhật Dùng thành công.');
        } catch (QueryException $e) {
        // Catch database-related errors
        return response()->json(['Lỗi' => 'Cơ Sở dữ liệu lỗi ' . $e->getMessage()], 500);
    } catch (Exception $e) {
        // Catch any other exceptions
        return response()->json(['Lỗi' => '' . $e->getMessage()], 500);
    }
    }
     public function handleRemoveUser($id)
    {
  $User = User::findOrFail($id);
        // Delete the User
        $User->delete();
        // Return a response
        return back()->with('cuccess', 'Xoá Người Dùng thành công.');
    }
      public function handleSearchUsers(Request $request)
    {

    }
     public function handleAddUser(Request $request)
    {
 // Validate the incoming request data
        try{
        $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'password' => 'required|string', // Loại Người Dùng
        'role' => 'required|string', // Loại Người Dùng
        'status' => 'string', // Loại Người Dùng
        ]);
        // Create a new User
        $role = roles::where('name', $request->role)->first();
        if(!$role){
        return back()->with('error', 'Không có Vai Trò Này.');
        }
       $user= User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' =>  bcrypt($validated['password']),
        'status' => $validated['status'],
       ]);
       $user->roles()->attach($role->id);  // Thêm quyền vào user
        // Return a response
        return redirect('/users')->with('cuccess', 'Thêm Người Dùng thành công.');
        } catch (QueryException $e) {
        // Catch database-related errors
        return response()->json(['Lỗi' => 'Cơ Sở dữ liệu lỗi ' . $e->getMessage()], 500);
    } catch (Exception $e) {
        // Catch any other exceptions
        return response()->json(['Lỗi' => '' . $e->getMessage()], 500);
    }
    }
    public function EditUser ($id){
         $user = User::with('roles')->where('id',$id)->first();
        return view('edit_user',compact('user'));    
    }
     public function Search_Users (){
         $users = User::all();
        return view('users.search',compact('users'));    
    }
    // view all Users
    public function All_Users (){
      $users = User::with('roles')->get();
         return view('users',compact('users'));
    }
    // view add Users
    public function Add_Users (){
            return view('add_users');
    }
}
