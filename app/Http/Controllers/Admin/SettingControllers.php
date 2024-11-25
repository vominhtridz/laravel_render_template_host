<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\settings;
use App\Models\shipfee;
use App\Models\tax;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class SettingControllers extends Controller
{


 public function handleAddTax(Request $request)
    {
        // Validate the incoming request data
       try{
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'tax_rate'    => 'required|numeric|min:0|max:100',
            'description' => 'nullable|string|max:1000',
            'tax_type'    => 'required|string|in:VAT,Sales Tax,Service Tax',
            'start_date'  => 'nullable|date|before_or_equal:end_date',
            'end_date'    => 'nullable|date|after_or_equal:start_date',
            'currency'    => 'required|string|size:3|in:USD,EUR,VND', // Bạn có thể thêm các mã tiền tệ khác nếu cần.
            'exemption_criteria '=> 'nullable|string|max:1000',
            'is_vat'   => 'boolean',
            'applicable_to' => '',
            'status'    => 'string',
        ],[
            'name.required' => 'Tên là bắt buộc.',
            'tax_rate.required' => 'Tỷ lệ thuế là bắt buộc.',
            'tax_rate.numeric' => 'Tỷ lệ thuế phải là số.',
            'tax_rate.min' => 'Tỷ lệ thuế phải lớn hơn hoặc bằng 0.',
            'tax_rate.max' => 'Tỷ lệ thuế không được vượt quá 100.',
            'tax_type.required' => 'Loại thuế là bắt buộc.',
            'tax_type.in' => 'Loại thuế phải là một trong các giá trị: VAT, Sales Tax, Service Tax.',
            'start_date.required' => 'Ngày bắt đầu là bắt buộc.',
            'start_date.date' => 'Ngày bắt đầu phải là một ngày hợp lệ.',
            'start_date.before_or_equal' => 'Ngày bắt đầu phải trước hoặc bằng ngày kết thúc.',
            'end_date.date' => 'Ngày kết thúc phải là một ngày hợp lệ.',
            'currency.required' => 'Tiền tệ là bắt buộc.',
            'currency.size' => 'Mã tiền tệ phải có 3 ký tự.',
            'currency.in' => 'Tiền tệ phải là một trong các giá trị: USD, EUR, VND.',
            'is_vat.required' => 'Thông tin VAT là bắt buộc.',
            'is_vat.boolean' => 'Thông tin VAT phải là giá trị boolean (true/false).',
            'applicable_to.required' => 'Đối tượng áp dụng là bắt buộc.',
            'status.required' => 'Trạng thái là bắt buộc.',
            'status.boolean' => 'Trạng thái phải là giá trị boolean (true/false).',
        ]);

        // Create a new category
        Tax::create($validated);
        // Return a response
        return redirect('/settings/tax')->with('cuccess', 'Thêm Thuế  thành công.');
       }
        catch (QueryException $e) {
        // Catch database-related errors
        return response()->json(['Lỗi' => 'Cơ Sở dữ liệu lỗi ' . $e->getMessage()], 500);
    } catch (Exception $e) {
        // Catch any other exceptions
        return response()->json(['Lỗi' => '' . $e->getMessage()], 500);
    }
    }


    // Handle Edit tax
    public function handleEditTax(Request $request, $id)
    {
           $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'tax_rate'    => 'required|numeric|min:0|max:100',
            'description' => 'nullable|string|max:1000',
            'tax_type'    => 'required|string|in:VAT,Sales Tax,Service Tax',
            'start_date'  => 'nullable|date|before_or_equal:end_date',
            'end_date'    => 'nullable|date|after_or_equal:start_date',
            'currency'    => 'required|string|size:3|in:USD,EUR,VND', // Bạn có thể thêm các mã tiền tệ khác nếu cần.
            'exemption_criteria '=> 'nullable|string|max:1000',
            'is_vat'   => 'boolean',
            'applicable_to' => '',
            'status'    => 'string',
        ],[
            'name.required' => 'Tên là bắt buộc.',
            'tax_rate.required' => 'Tỷ lệ thuế là bắt buộc.',
            'tax_rate.numeric' => 'Tỷ lệ thuế phải là số.',
            'tax_rate.min' => 'Tỷ lệ thuế phải lớn hơn hoặc bằng 0.',
            'tax_rate.max' => 'Tỷ lệ thuế không được vượt quá 100.',
            'tax_type.required' => 'Loại thuế là bắt buộc.',
            'tax_type.in' => 'Loại thuế phải là một trong các giá trị: VAT, Sales Tax, Service Tax.',
            'start_date.required' => 'Ngày bắt đầu là bắt buộc.',
            'start_date.date' => 'Ngày bắt đầu phải là một ngày hợp lệ.',
            'start_date.before_or_equal' => 'Ngày bắt đầu phải trước hoặc bằng ngày kết thúc.',
            'end_date.date' => 'Ngày kết thúc phải là một ngày hợp lệ.',
            'currency.required' => 'Tiền tệ là bắt buộc.',
            'currency.size' => 'Mã tiền tệ phải có 3 ký tự.',
            'currency.in' => 'Tiền tệ phải là một trong các giá trị: USD, EUR, VND.',
            'is_vat.required' => 'Thông tin VAT là bắt buộc.',
            'is_vat.boolean' => 'Thông tin VAT phải là giá trị boolean (true/false).',
            'applicable_to.required' => 'Đối tượng áp dụng là bắt buộc.',
            'status.required' => 'Trạng thái là bắt buộc.',
            'status.boolean' => 'Trạng thái phải là giá trị boolean (true/false).',
        ]);
        $tax = tax::find($id);
        // Create a new category
        $tax->update($validated);
        // Return a response
        return redirect('/settings/tax')->with('cuccess', 'Cập Nhật Thuế thành công.');
    }

    // Handle Remove tax
    public function handleRemoveTax($id)
    {
        // Find the category by ID
        $tax = tax::findOrFail($id);
        // Delete the category
        $tax->delete();
        // Return a response
        return back()->with('cuccess', 'Xoá Thuế Thành Công');
    }
     public function handleAddshipfee(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
        'shipping_fee' => 'required|numeric|min:0', // shipping fee phải là số và không âm
        'shipfee_type' => 'required|string|max:255', // Loại phí vận chuyển, chuỗi không quá 255 ký tự
        'is_free_shipping' => 'nullable|boolean', // Phải là boolean (0 hoặc 1)
        'discount_amount' => 'nullable|numeric|min:0', // Số tiền giảm, có thể null nhưng nếu có thì phải là số và không âm
        'status' => 'string', // Trạng thái chỉ có thể là 'active' hoặc 'inactive'
        ]);
        // Create a new shipfee
        shipfee::create($validated);
        // Return a response
        return redirect('/settings/tax')->with('cuccess', 'Thêm Phí Vận Chuyển thành công.');
    }
    // Handle Edit tax
    public function handleEditshipfee(Request $request, $id)
    {
         $validated = $request->validate([
        'shipping_fee' => 'required|numeric|min:0', // shipping fee phải là số và không âm
        'shipfee_type' => 'required|string|max:255', // Loại phí vận chuyển, chuỗi không quá 255 ký tự
        'is_free_shipping' => 'nullable|boolean', // Phải là boolean (0 hoặc 1)
        'discount_amount' => 'nullable|numeric|min:0', // Số tiền giảm, có thể null nhưng nếu có thì phải là số và không âm
        'status' => 'string', // Trạng thái chỉ có thể là 'active' hoặc 'inactive'
        ]);
        $shipfee = shipfee::find($id);
        // Create a new shipfee
        $shipfee->update($validated);
        // Return a response
        return redirect('/settings/tax')->with('cuccess', 'Cập Nhật Phí Vận Chuyển thành công.');
    }

    // Handle Remove shipfee
    public function handleRemoveshipfee($id)
    {
        // Find the shipfee by ID
        $shipfee = shipfee::findOrFail($id);
        // Delete the shipfee
        $shipfee->delete();
        // Return a response
        return back()->with('cuccess', 'Xoá Phí Vận Chuyển thành công.');
    }
     public function Settings (){
        $settings = settings::first() ?? null;
        return view('settings',compact('settings'));
    }
   
        public function Settings_Email (){
        return view('email');
    }
    public function Settings_Languages (){
        return view('languages');
    }
    public function Settings_Tax (){
        $taxes = tax::all() ?? null;
        $shipfees = shipfee::all() ?? null;
        return view('Tax',compact('shipfees','taxes'));
    }
 public function Add_Tax (){
        return view('add_tax');
    }
     public function Edit_Tax ($id){
        $tax = tax::find($id)->first();
        return view('edit_tax',compact('tax'));
    }
     public function Add_Shipfee (){

        return view('add_Shipfee');
    }
     public function Edit_Shipfee ($id){
        $shippingFee = shipfee::find($id)->first();

        return view('edit_Shipfee',compact('shippingFee'));
    }
    public function Settings_payment (){
        return view('payments');
    }
     public function handleSetting_General (Request $request){
         $request->validate([
            'web_name' => 'required|string|max:255',
            'email' => 'required|email',
            'infor_bank' => 'required|string',
            'address' => 'required|string',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
        ]);
        $imagePath = time() .'.' . $request->file('logo')->getClientOriginalExtension();
        $request->file('logo')->move(public_path('images'),$imagePath );
        $image = 'images/' . $imagePath;
        $settings = settings::first();
        if(!$settings){
             $newSettings = settings::create([
                'web_name'=> $request->web_name,
                'email'=> $request->email,
                'logo'=> $image,
                'address' => $request->address,

                'infor_bank'=> $request->infor_bank
            ]);
        return redirect('/settings')->with([
        'cuccess' => 'Cập Nhật Thành Công.',
        'settings' => $newSettings,
        ]);
        }
       $update = $settings->update([
                'web_name'=> $request->web_name,
                'email'=> $request->email,
                'logo'=> $image,
                'address' => $request->address,
                'infor_bank'=> $request->infor_bank
            ]);
    return redirect('/settings')->with([
        'cuccess' => 'Cập Nhật Thành Công.',
        'settings' => $update,
        ]);
    }
    
    
    public function Settings_delivery (){
        return view('delivery');
    }
    
}
