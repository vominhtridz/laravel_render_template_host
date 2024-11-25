<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Mail\verifyLinkEmail;
use App\Models\customers;
use App\Models\Product;
use App\Models\settings;
use App\Models\shipfee;
use App\Models\tax;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class CustomerControllers extends Controller
{
 
public function register_customer(Request $request){
    $validated = Validator::make($request->all(),[
        'email' => 'required|email|unique:customers',
        'name' => 'required|string',
        'password' => 'required|string|min:8',
        'image'=>'string',
        'password1' => 'required|string|min:8|same:password',
        ],[ 
        'email.required' => 'Email không bỏ trống',
        'name.required' => 'tên không bỏ trống',
        'name.string' => 'tên phải là số hoặc kí tự đặc biệt',
        'email.email' => 'Email không hợp lệ',
        'email.unique' => 'Email đã có sẵn',
        'password.required' => 'Mật khẩu không bỏ trống',
        'password.min' => 'Mật khẩu ít nhất 8 kí tự',
         'password1.required' => 'Xác Nhận Mật khẩu không bỏ trống',
        'password1.min' => 'Mật khẩu ít nhất 8 kí tự',
        'password1.same' => 'Xác thực mật khẩu không khớp',]);
        if($validated->fails()){
            return response()->json(['error'=>$validated->errors()],400);
        }
        try{
            $customerData = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => password_hash($request->password, PASSWORD_DEFAULT),
            ];
            if($request->image){
                $customerData['image'] = $request->image;
            }
        customers::create($customerData);
            return response()->json(['cuccess'=>'Đăng kí thành công.'],201);
        }
        catch(QueryException $err){
            return response()->json(['error'=>$err],500);
        }
}

public function login_customer(Request $request){
      $validated = Validator::make($request->all(),[
        'email' => 'required|email',
        'password' => 'required|string|min:8',
        ],[ 
        'email.required' => 'Email không bỏ trống',
        'email.email' => 'Email không hợp lệ',
        'password.required' => 'Mật khẩu không bỏ trống',
        'password.min' => 'Mật khẩu ít nhất 8 kí tự',
   ],[ 
        'email.required' => 'Email không bỏ trống',
        'email.email' => 'Email không hợp lệ',
        'password.required' => 'Mật khẩu không bỏ trống',
        'password.min' => 'Mật khẩu ít nhất 8 kí tự',]);
    if($validated->fails()){
        return response()->json(['error'=>$validated->errors()],400);
    }
  try{
  $customer = customers::where('email', $request->email)->first();
    if(!$customer){
        return response()->json(['error'=>'Email không có trên hệ thống.'],400);
    }
    if ($customer && Hash::check($request->password, $customer->password)) {
        // Authentication passed, you can log the user in manually
        $token = $customer->createToken('api_token')->plainTextToken;
        return response()->json(['cuccess'=>'Đăng nhập thành công.','access_token'=>$token,'id'=>$customer->customer_id],200);
    } else {
        // Authentication failed
        return response()->json(['error' => 'Mật khẩu không chính xác'], 401);
    }
  }
  catch(QueryException $err){
    return response()->json(['error'=>$err],500);
  }
}
public function send_Link_Verify_Email (Request $request){
    // check email exits
        $email = $request->email;
        $customer = customers::where('email', $email)->first();
        if(!$customer){
            return response()->json(['error'=>'Email không có trên hệ thống'], 404);
        }
        $token = $request->code;
        if(!$token){
            return response()->json(['error'=>'không tìm thấy mã xác nhận.'], 404);
        }
       customers::where('email',$email)->update(['remember_token' => strval($token)]);
        // create link for verification email address
        $linkverifyEmail = 'http://localhost:5174/reset_password/'.$token;
        // send email
        Mail::to($email)->send(new verifyLinkEmail($linkverifyEmail));
        return response()->json(['cuccess'=>'vui lòng kiểm tra Email để xác nhận.']);
        
}
public function logout_customer(Request $request)
{
    try {
        // Kiểm tra xem người dùng có đang được xác thực hay không
        $user = $request->user();
        if (!$user) {
            return response()->json(['error' => 'Token không hợp lệ hoặc đã hết hạn'], 401);
        }
        // Lấy token hiện tại
        $token = $user->currentAccessToken();
        if ($token) {
        // Xoá token hiện tại
            $token->delete();
            return response()->json(['success' => 'Đăng xuất thành công.'], 200);
        } else {
            return response()->json(['error' => 'Không tìm thấy token'], 400);
        }
    } catch (\Throwable $e) {
        return response()->json(['error' => 'Đăng xuất thất bại', 'message' => $e->getMessage()], 500);
    }
   
}
public function Filter_Product(){
    try {
        $product = Product::with('categories', 'reviews')->get();
           
        return response()->json([
            'status' => 'success',
            'data' => $product
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

public function getSettings(){
        try{
            $settings = settings::all();
        if($settings){
            return response()->json([
                'status'=>'success',
                'data'=>$settings
            ], 200);
        }
        return response()->json([
                'status'=>'error',
                'message'=>'Không tìm thấy Cài Đặt'
            ], 404);
        }
         catch(QueryException $e) {
        return response()->json(['error'=>$e],500);
    }

}
public function get_Product($id){
        try{
            $product = Product::where('id',$id)->first();
        if($product){
            return response()->json([
                'status'=>'success',
                'data'=>$product
            ], 200);
        }
        return response()->json([
                'status'=>'error',
                'message'=>'Không tìm thấy Sản Phẩm'
            ], 404);
        }
         catch(QueryException $e) {
        return response()->json(['error'=>$e],500);
    }

}

public function customer_profile($id){
        $user = customers::where('customer_id',$id)->first();
        if($user){
            return response()->json([
                'status'=>'success',
                'data'=>$user
            ], 200);
        }
        return response()->json([
                'status'=>'error',
                'message'=>'Không tìm thấy người dùng'
            ], 200);
}
public function handle_edit_Customer(Request $request,$id){
 $validated = Validator::make($request->all(),[
            'email' => 'email|nullable',
            'name' => 'string|nullable',
            'image'=>'string|nullable',
            'phonenumber'=>'numeric|nullable',
            'address'=>'string|nullable',
            'zip_code'=>'numeric|nullable',
            'birthday'=>'date|nullable',
        ],[ 
        'email.email' => 'Email không hợp lệ',
   ],[ 
        'email.email' => 'Email không hợp lệ',
        'name.email' => 'Tên không hợp lệ',
        'image.string' => 'Ảnh không hợp lệ',
        'address.string' => 'Địa chỉ không hợp lệ',
        'phonenumber.numeric' => 'Số điện thoại không hợp lệ',
        'zip_code.numeric' => 'Mã bưu điện không hợp lệ',
        'birthday.date'=>'Trường Sinh Nhật khôn hợp lệ',
    
    ]);
    // Trả về lỗi form  
    if($validated->fails()){
        return response()->json(['error'=>$validated->errors()],400);
    }
    try {
        $customer = customers::find($id);
        if(!$customer){
            return response()->json(['error'=>'Không tìm thấy người dùng.'],404);
        }
        $user = $request->user(); // Hoặc tìm user theo id nếu cần
        $user->update($request->only(['email','birthday', 'name', 'image', 'phonenumber', 'address', 'zip_code']));
        return response()->json(['message' => 'Cập nhật thành công', 'user' => $user], 200);
    }
    catch(QueryException $e) {
        return response()->json(['error'=>$e],500);
    }
}


public function handle_Remove_Customer(Request $request,$id){

   try {
        $currentUser = customers::find($id);
        if(!$currentUser){
            return response()->json(['error'=>'Không tìm thấy người dùng.'],404);
        }
        // Kiểm tra xem người dùng có đang được xác thực hay không
        $user = $request->user();
        if (!$user) {
            return response()->json(['error' => 'Token không hợp lệ hoặc đã hết hạn'], 401);
        }
        // Lấy token hiện tại
        $token = $user->currentAccessToken();
        if ($token) {
        // Xoá token hiện tại
            $token->delete();
            $currentUser->delete();
            return response()->json(['cuccess' => 'Xoá thành công.'], 200);
        } else {
            return response()->json(['error' => 'Không tìm thấy token'], 400);
        }
    } catch (\Throwable $e) {
        return response()->json(['error' => 'Xoá thất bại', 'message' => $e->getMessage()], 500);
    }
}

public function handle_Change_password(Request $request,$id){
    $validated = Validator::make($request->all(), [
        'password' => 'required|string|min:8',
        'password1' => 'required|string|min:8|same:password',
    ], [
        'password.required' => 'Mật khẩu không bỏ trống',
        'password.string' => 'Mật khẩu phải là 1 chuỗi',
        'password.min' => 'Mật khẩu ít nhất 8 kí tự',
        'password1.required' => 'Xác Nhận Mật khẩu không bỏtrống',
        'password1.string' => 'Xác Nhận Mật khẩu phải là 1 chuỗi',
        'password1.min' => 'Xác Nhận Mật khẩu ít nhất 8 kí tự',
        'password1.same' => 'Xác Nhận Mật khẩu không giống với mật khẩu',
    ]);
    if($validated->fails()){
        return response()->json(['error'=>$validated->errors()],400);
    }
    try{
        $customer = customers::where( 'customer_id',$id)->first();
        if(!$customer){
        return response()->json(['error'=>'Không tìm thấy người dùng'],404);
        }
        $customer->password = password_hash($request->password, PASSWORD_DEFAULT);
        $customer->remember_token = null;
        $customer->save();
        return response()->json(['cuccess'=>'Thay đổi mật khẩu thành công.'],200);
    }
    catch(QueryException $err){
        return response()->json(['error'=>$err],500);
    }
}
public function handle_Reset_password(Request $request){
    $validated = Validator::make($request->all(), [
        'password' => 'required|string|min:8',
        'password1' => 'required|string|min:8|same:password',
    ], [
        'password.required' => 'Mật khẩu không bỏ trống',
        'password.string' => 'Mật khẩu phải là 1 chuỗi',
        'password.min' => 'Mật khẩu ít nhất 8 kí tự',
        'password1.required' => 'Xác Nhận Mật khẩu không bỏtrống',
        'password1.string' => 'Xác Nhận Mật khẩu phải là 1 chuỗi',
        'password1.min' => 'Xác Nhận Mật khẩu ít nhất 8 kí tự',
        'password1.same' => 'Xác Nhận Mật khẩu không giống với mật khẩu',
    ]);
    if($validated->fails()){
        return response()->json(['error'=>$validated->errors()],400);
    }
    try{
        $customer = customers::where( 'remember_token',strval($request->code))->first();
            if(!$customer){
            return response()->json(['error'=>'Mã xác nhận không đúng hoặc đã hết hạn.'],404);
        }
        $customer->password = password_hash($request->password, PASSWORD_DEFAULT);
        $customer->remember_token = null;
        $customer->save();
        return response()->json(['cuccess'=>'Thay đổi mật khẩu thành công.'],200);
    }
    catch(QueryException $err){
        return response()->json(['error'=>$err],500);
    }

}
public function getTax(){
        $tax = tax::all();
        return response()->json(['data' => $tax]);
}
public function getShipfee(){
        $shipfee = shipfee::all();
        return response()->json(['data' => $shipfee]);
}
}
