<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Banner_Controller;
use App\Http\Controllers\Admin\CategoryControllers;
use App\Http\Controllers\Admin\ProductControllers;
use App\Http\Controllers\Admin\ReportControllers;
use App\Http\Controllers\Admin\ReviewControllers;
use App\Http\Controllers\Admin\SettingControllers;
use App\Http\Controllers\Admin\UserControllers;
use App\Http\Controllers\Admin\CustomerControllers as AdminCustomersController;
use App\Http\Controllers\Admin\Promotion_Controller;
use App\Http\Controllers\API\OrderControllers;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
// login register and forgor password
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class,'login'])->name('login');
    Route::get('/register', [AuthController::class,'register'])->name('register');
    Route::post('/login', [AuthController::class,'handle_login'])->name('handle.login');
    Route::post('/register', [AuthController::class,'handle_register'])->name('handle.register');
    Route::get('/forgotpassword', [AuthController::class, 'forgot_password'])->name('forgot.password');
    Route::post('/create/verify/email', [AuthController::class, 'send_Link_Verify_Email'])->name('send.Link.Verify.Email');
    Route::get('/resetpwd/{token}', [AuthController::class, 'Reset_Pwd'])->name('Reset.Pwd');
    Route::get('/verify/cuccess', [AuthController::class, 'Cuccess_Verify'])->name('verify.cuccess');
    Route::post('/resetpwd/{token}', [AuthController::class, 'handle_Reset_Pwd'])->name('handle.Reset.Pwd');
});
// JUST ADMIN CAN DO 
Route::group(['middleware' => ['auth', 'role:admin']], function () {
 // Settings
    Route::get('/settings', [SettingControllers::class, 'Settings'])->name('Settings');
    Route::get('/settings/email', [SettingControllers::class, 'Settings_Email'])->name('Settings_Email');
    Route::get('/settings/languages', [SettingControllers::class, 'Settings_Languages'])->name('Settings_Languages');
    Route::get('/settings/payment', [SettingControllers::class, 'Settings_payment'])->name('Settings_payment');
    Route::get('/settings/delivery', [SettingControllers::class, 'Settings_delivery'])->name('Settings_delivery');
    Route::get('/settings/tax', [SettingControllers::class, 'Settings_Tax'])->name('Settings_Tax');
    Route::get('/settings/tax/add', [SettingControllers::class, 'Add_Tax'])->name('Add_Tax');
    Route::get('/settings/tax/edit/{id}', [SettingControllers::class, 'Edit_Tax'])->name('Edit_Tax');
    Route::get('/settings/shipfee/add', [SettingControllers::class, 'Add_Shipfee'])->name('Add_Shipfee');
    Route::get('/settings/shipfee/edit/{id}', [SettingControllers::class, 'Edit_Shipfee'])->name('Edit_Shipfee');
      // MANAGE SETTINGS
    Route::post('/settings/general', [SettingControllers::class,'handleSetting_General'])->name('handleSetting_General');
    Route::post('/tax/add', [SettingControllers::class,'handleAddTax'])->name('handleAddTax');
    Route::put('/tax/edit/{id}', [SettingControllers::class,'handleEditTax'])->name('handleEditTax');
    Route::delete('tax/customers/delete/{id}', [SettingControllers::class,'handleRemoveTax'])->name('handleRemoveTax');
    Route::post('/shipfee/add', [SettingControllers::class,'handleAddshipfee'])->name('handleAddshipfee');
    Route::put('/shipfee/edit/{id}', [SettingControllers::class,'handleEditshipfee'])->name('handleEditshipfee');
    Route::delete('/shipfee/delete/{id}', [SettingControllers::class,'handleRemoveshipfee'])->name('handleRemoveshipfee');
//  MANAGE USERS 
     Route::post('/users/add', [UserControllers::class,'handleAddUser'])->name('handleAddUser');
     Route::post('/users/search/{value}', [UserControllers::class,'handleSearchUsers'])->name('handleSearchUsers');
     Route::put('/users/edit/{id}', [UserControllers::class,'handleEditUser'])->name('handleEditUser');
     Route::delete('/users/delete/{id}', [UserControllers::class,'handleRemoveUser'])->name('handleRemoveUser');
Route::delete('/categories/delete/{id}', [CategoryControllers::class,'handleRemoveCategories'])->name('handleRemoveCategories');
 Route::delete('/banners/delete/{id}', [Banner_Controller::class,'handleRemoveBanner'])->name('handleRemoveBanner');
 Route::delete('/products/delete/{id}', [ProductControllers::class,'handleRemoveProduct'])->name('handleRemoveProduct');
 Route::delete('/promotion/delete/{id}', [Promotion_Controller::class,'handleRemovepromotion'])->name('handleRemovepromotion');
 Route::delete('/customers/delete/{id}', [CategoryControllers::class,'handleRemovecustomers'])->name('handleRemovecustomers');
     Route::delete('orders/delete/{id}', [OrderControllers::class, 'handle_remove_order'])->name('admin.orders.remove');
});
Route::group(['middleware' => ['auth','roles:admin,editor,viewer']], function () {
    Route::get('/', [AdminController::class, 'home'])->name('home');
    // Products
    Route::get('/products', [ProductControllers::class, 'All_Product'])->name('All_Product');
    Route::get('/products/add', [ProductControllers::class, 'Add_Product'])->name('Add_Product');
    Route::get('/products/edit/{id}', [ProductControllers::class, 'edit_product'])->name('edit_product');
    Route::get('/products/search', [ProductControllers::class, 'SearchProduct'])->name('SearchProduct');
    // Orders
    Route::get('/orders', [AdminController::class, 'AllOrders'])->name('AllOrders');
    Route::get('/orders/edit/{id}', [AdminController::class, 'EditOrder'])->name('EditOrder');
    Route::get('/orders/detail/{order_id}', [AdminController::class, 'view_detail_order'])->name('view_detail_order');
    Route::get('/orders/tracking', [AdminController::class, 'tracking_Oders'])->name('tracking_Oders');
    // Users
    Route::get('/users', [UserControllers::class, 'All_Users'])->name('All_Users');
    Route::get('/users/add', [UserControllers::class, 'Add_Users'])->name('Add_Users');
    Route::get('/users/search', [UserControllers::class, 'Search_Users'])->name('Search_Users');
    Route::get('/users/edit/{id}', [UserControllers::class, 'EditUser'])->name('EditUser');
    // Categories
    Route::get('/categories', [CategoryControllers::class, 'All_category'])->name('All_category');
    Route::get('/categories/edit/{id}', [CategoryControllers::class, 'EditCategory'])->name('EditCategory');
    Route::get('/categories/add', [CategoryControllers::class, 'Add_category'])->name('Add_category');
    // Reviews
    Route::get('/reviews', [ReviewControllers::class, 'All_review'])->name('All_review');
    // Revenues  
    Route::get('/report/revenue', [ReportControllers::class, 'Revenue'])->name('Revenue');
    // Sales
    Route::get('/promotion/all', [Promotion_Controller::class, 'Promotion'])->name('Promotion');
    Route::get('/promotion/add', [Promotion_Controller::class, 'Add_Promotion'])->name('Add_Promotion');
    Route::get('/promotion/edit/{id}', [Promotion_Controller::class, 'Edit_Promotion'])->name('Edit_Promotion');
    // banner
    Route::get('/banners', [Banner_Controller::class, 'Banners'])->name('Banners');
    Route::get('/banners/add', [Banner_Controller::class, 'Add_Banner'])->name('Add_Banner');
    Route::get('/banners/edit/{id}', [Banner_Controller::class, 'Edit_Banner'])->name('Edit_Banner');
    // Support
    Route::get('customers', [AdminCustomersController::class, 'List_Support_Customer'])->name('List_Support_Customer');
    Route::get('customers/getAll', [AdminCustomersController::class, 'getAll_Customer'])->name('getAll_Customer');
    Route::get('customers/infor/{id}', [AdminCustomersController::class, 'InforCustomers'])->name('InforCustomers');
    Route::get('customers/messages', [AdminCustomersController::class, 'support_messages'])->name('support_messages');
});
 Route::post('/logout', [AuthController::class,'logout'])->name('logout')->middleware('auth');
 
// admin post route
Route::group(['middleware'=> 'auth', 'roles:admin,editor'],function () {
    //  MANAGE PRODUCTION
     Route::post('/products/add', [ProductControllers::class,'handleAddProduct'])->name('handleAddProduct');
     Route::post('/products/search', [ProductControllers::class,'handleSearchProduct'])->name('handleSearchProduct');
     Route::put('/products/edit/{id}', [ProductControllers::class,'handleEditProduct'])->name('handleEditProduct');
    //  MANAGE CATEGORIES
     Route::post('/categories/add', [CategoryControllers::class,'handleAddCategories'])->name('handleAddCategories');
     Route::put('/categories/edit/{id}', [CategoryControllers::class,'handleEditCategories'])->name('handleEditCategories');
    // MANAGE BANNERS
     Route::post('/banners/add', [Banner_Controller::class,'handleAddBanner'])->name('handleAddBanner');
     Route::post('/banners/search/{value}', [Banner_Controller::class,'handleSearchBanner'])->name('handleSearchBanner');
     Route::put('/banners/edit/{id}', [Banner_Controller::class,'handleEditBanner'])->name('handleEditBanner');
     // MANAGE CUSTOMERS
   
         Route::post('orders/edit/{id}', [OrderControllers::class, 'handle_edit_order'])->name('handle.edit.order');
         Route::post('orders/updatestatus/{id}', [OrderControllers::class, 'UpdateStatusOrder'])->name('UpdateStatusOrder');
     Route::post('/customers/add', [AdminCustomersController::class,'handleAddcustomers'])->name('handleAddcustomers');
     Route::put('/customers/edit/{id}', [AdminCustomersController::class,'handleEditcustomers'])->name('handleEditcustomers');
    // MANAGE PROMOTIONS
    Route::post('/promotion/add', [Promotion_Controller::class,'handleAddpromotion'])->name('handleAddpromotion');
    Route::put('/promotion/edit/{id}', [Promotion_Controller::class,'handleEditpromotion'])->name('handleEditpromotion');
});

