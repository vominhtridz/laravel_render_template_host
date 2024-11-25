<?php

use App\Http\Controllers\API\Address_Controller;
use App\Http\Controllers\API\Bank_Controller;
use App\Http\Controllers\API\Cart_Controller;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\CustomerControllers;
use App\Http\Controllers\API\OrderControllers;
use App\Http\Controllers\API\Review_Cotroller;
use Illuminate\Support\Facades\Route;
Route::group(['middleware' => 'guest:sanctum'], function () {
    Route::post('customers/login', [CustomerControllers::class, 'login_customer'])->name('login_customer');
    Route::post('customers/register', [CustomerControllers::class, 'register_customer'])->name('register_customer');
    Route::post('customers/verify', [CustomerControllers::class, 'send_Link_Verify_Email'])->name('verify_email');
    Route::get('/customers/categories', action: [CategoryController::class, 'All_category'])->name('All_category');
    Route::get('customers/products/categories/{id}', action: [CategoryController::class, 'getAllProductById'])->name('All_category');
    Route::get('/customers/banners', action: [CategoryController::class, 'All_banner'])->name('All_banner');
    Route::get('/customers/categories/{slug}', action: [CategoryController::class, 'Get_Productby_category'])->name('All_category');
    Route::get('customers/product/{id}', [CustomerControllers::class, 'get_Product'])->name('get_Product');
    Route::get('customers/filter_product', [CustomerControllers::class, 'Filter_Product'])->name('FilterProduct');
    Route::get('settings/get', [CustomerControllers::class, 'getSettings'])->name('getSettings');
    // Authentication routes
    Route::post('customers/resetpwd', [CustomerControllers::class, 'handle_Reset_password'])->name('handle_Reset_password');
    Route::get('reviews/{id}', [Review_Cotroller::class, 'getAll_reviews'])->name('handle.get_reviews');
});
Route::group(['middleware' => 'auth:sanctum'], function () {
    // MANAGE Orders 
    Route::get('customers/profile/{id}', [CustomerControllers::class, 'customer_profile'])->name('customer_profile');
    Route::post('orders/add', [OrderControllers::class, 'handle_add_order'])->name('handle.add.order');
    Route::get('orders/getall/{id}', [OrderControllers::class, 'getOrderByCustomer_id'])->name('getOrderByCustomer_id');
    Route::post('orders/filter', [OrderControllers::class, 'FilterOrder'])->name('handle.FilterOrder');
    Route::post('orders/handle_cancel/{id}', [OrderControllers::class, 'handle_cancelOrder'])->name('handle_cancelOrder');
    Route::post('orders/search', [OrderControllers::class, 'SearchOrder'])->name('handle.SearchOrder');
    Route::delete('orders/delete/{id}', [OrderControllers::class, 'handle_remove_order'])->name('handle_remove_order');
    Route::post('customers/logout', [CustomerControllers::class, 'logout_customer'])->name('logout_customer');
    // MANAGE Products
    // MANAGE Customers
    Route::post('customers/changepwd/{id}', [CustomerControllers::class, 'handle_Change_password'])->name('handle_Change_password');
    Route::post('customers/edit/{id}', [CustomerControllers::class, 'handle_edit_Customer'])->name('handle_edit_Customer');
    Route::delete('customers/remove/{id}', [CustomerControllers::class, 'handle_Remove_Customer'])->name('handle_Remove_Customer');
    //  MANAGE CUSTOMER BANKS
    Route::post('banks/add', [Bank_Controller::class, 'handle_add_banks'])->name('handle.add.banks');
    Route::get('banks/{id}', [Bank_Controller::class, 'get_banks'])->name('handle.get_banks');
    Route::post('banks/edit/{id}', [Bank_Controller::class, 'handle_edit_banks'])->name('handle.edit.banks');
    Route::delete('banks/delete/{id}', [Bank_Controller::class, 'handle_remove_banks'])->name('handle.remove.banks');
    // MANAGE CUSTOMER ADDRESSES
    Route::post('address/add', [Address_Controller::class, 'handle_add_address'])->name('handle.add.address');
    Route::get('address/{id}', [Address_Controller::class, 'get_address'])->name('handle.get_address');
    Route::post('address/edit/{id}', [Address_Controller::class, 'handle_edit_address'])->name('handle.edit.address');
    Route::delete('address/delete/{id}', [Address_Controller::class, 'handle_remove_address'])->name('handle.remove.address');
    //MANAGE CUSTOMER REVIEWS
    Route::post('reviews/add', [Review_Cotroller::class, 'handle_add_reviews'])->name('handle.add.reviews');
    Route::post('reviews/edit/{id}', [Review_Cotroller::class, 'handle_edit_reviews'])->name('handle.edit.reviews');
    Route::delete('reviews/delete/{id}', [Review_Cotroller::class, 'handle_remove_reviews'])->name('handle.remove.reviews');
     //MANAGE Customer CART
    Route::post('cart/add', [Cart_Controller::class, 'handle_add_cart'])->name('handle.add.cart');
    Route::get('cart/{id}', [Cart_Controller::class, 'getAll_cart'])->name('handle.get_cart');
    Route::post('cart/edit/{id}', [Cart_Controller::class, 'handle_edit_cart'])->name('handle.edit.cart');
    Route::delete('cart/delete/{id}', [Cart_Controller::class, 'handle_remove_cart'])->name('handle.remove.cart');
    Route::delete('cart/delete', [Cart_Controller::class, 'handle_removeAll_cart'])->name('handle.remove.cart');
     //MANAGE Customer checkout
    Route::get('customers/tax/get', [CustomerControllers::class, 'getTax'])->name('getTax');
    Route::get('customers/shipfee/get', [CustomerControllers::class, 'getShipfee'])->name('getShipfee');


});