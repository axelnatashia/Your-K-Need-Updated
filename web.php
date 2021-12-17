<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home.index');

// auth
Route::get('/form_login', ['as' => 'form_login', 'uses' => 'LoginSetupController@form_login']);
Route::get('/form_login_admin', ['as' => 'form_login_admin', 'uses' => 'LoginSetupController@form_login_admin']);
Route::get('/form_register', ['as' => 'form_register', 'uses' => 'LoginSetupController@form_register']);
Route::get('/form_register_admin', ['as' => 'form_register_admin', 'uses' => 'LoginSetupController@form_register_admin']);
Route::post('/filter_login', ['as' => 'filter_login', 'uses' => 'LoginSetupController@filter_login']);
Route::post('/filter_register', ['as' => 'filter_register', 'uses' => 'LoginSetupController@filter_register']);
Route::get('/logout', ['as' => 'logout', 'uses' => 'LoginSetupController@logout']);

// admin
Route::get('/admin/profile', ['as' => 'admin.profile', 'uses' => 'AdminController@profile']);
Route::resource('admin', 'AdminController');

// seller
Route::get('/seller/profile', ['as' => 'seller.profile', 'uses' => 'SellerController@profile']);
Route::resource('seller', 'SellerController');

// seller product
Route::get('seller_product_increase/{id}', 'SellerProductController@increase')->name('seller_product_increase.increase');
Route::resource('seller_product', 'SellerProductController');

// serial number
Route::resource('serial_number', 'SerialNumberController');

// buyer
Route::get('/buyer/profile', ['as' => 'buyer.profile', 'uses' => 'BuyerController@profile']);
Route::resource('buyer', 'BuyerController');

// wishlist
Route::resource('wishlist', 'WishlistController');

// cart
Route::resource('cart', 'CartController');

// paylater
Route::resource('paylater', 'PaylaterController');

// payment method
Route::resource('payment_method', 'PaymentMethodController');

// checkout
Route::resource('checkout', 'CheckoutController');

// checkout detail
Route::resource('checkout_detail', 'CheckoutDetailController');

// chat
// Route::resource('chat', 'ChatController');
Route::get('chat_admin', 'ChatController@admin_index')->name('chat.admin.index');
Route::get('chat_seller', 'ChatController@seller_index')->name('chat.seller.index');
Route::get('chat_buyer', 'ChatController@buyer_index')->name('chat.buyer.index');

Route::get('chat_admin/create', 'ChatController@admin_create')->name('chat.admin.create');
Route::get('chat_seller/create', 'ChatController@seller_create')->name('chat.seller.create');
Route::get('chat_buyer/create', 'ChatController@buyer_create')->name('chat.buyer.create');

Route::post('chat_admin/store', 'ChatController@admin_store')->name('chat.admin.store');
Route::post('chat_seller/store', 'ChatController@seller_store')->name('chat.seller.store');
Route::post('chat_buyer/store', 'ChatController@buyer_store')->name('chat.buyer.store');


Route::get('chat_admin/{chat}/show', 'ChatController@admin_show')->name('chat.admin.show');
Route::get('chat_seller/{chat}/show', 'ChatController@seller_show')->name('chat.seller.show');
Route::get('chat_buyer/{chat}/show', 'ChatController@buyer_show')->name('chat.buyer.show');

// chat detail
Route::resource('chat_detail', 'ChatDetailController');

// landing
Route::group(['prefix' => 'landing', 'as' => 'landing.'], function() {
    Route::get('/', ['as' => 'index', 'uses' => 'LandingController@index']);
    Route::get('/wishlist', ['as' => 'wishlist', 'uses' => 'LandingController@wishlist']);
    Route::get('/cart', ['as' => 'cart', 'uses' => 'LandingController@cart']);
    Route::get('/paylater', ['as' => 'paylater', 'uses' => 'LandingController@paylater']);
    // Route::get('/product', ['as' => 'product', 'uses' => 'LandingController@product']);
    Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'LandingController@product_index']);
        Route::get('/{sellerProduct}', ['as' => 'show', 'uses' => 'LandingController@product_show']);
    });
    Route::group(['prefix' => 'checkout', 'as' => 'checkout.'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'LandingController@checkout_index']);
        Route::get('/{checkout}/export', ['as' => 'export', 'uses' => 'LandingController@export']);
        Route::get('/{checkout}/edit', ['as' => 'edit', 'uses' => 'LandingController@checkout_edit']);
        Route::get('/{checkout}/edit_form/{checkout_detail}', ['as' => 'edit_form', 'uses' => 'LandingController@checkout_edit_form']);
    });
});


// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
