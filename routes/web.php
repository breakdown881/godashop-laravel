<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;

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

Route::get('/', HomeController::class . "@index")->name("index");
Route::get('san-pham', ProductController::class . "@index")->name("product.index");
Route::get('danh-muc/{slug}', ProductController::class . "@index")->name("category.show");
Route::get('san-pham/{slug}.html', ProductController::class . "@show")->name("product.show");
Route::get('san-pham/search', ProductController::class . "@search")->name("product.search");
// Route::get('khoang-gia/{price-range}', ProductController::class . "@index")->name("category.show");
Route::post('comment/store', CommentController::class . "@store")->name("comment.store");
Route::post('register', RegisterController::class . "@register")->name("register");
Route::post('login', LoginController::class . "@login")->name("login");
Route::post('logout', LoginController::class . "@logout")->name("logout");

Route::get('existingEmail', RegisterController::class . "@existingEmail")->name("existingEmail");

// Route::middleware("auth")->group(function() {
    Route::get('carts/add', CartController::class . "@add")->name("cart.add");
    Route::get('carts/show', CartController::class . "@show")->name("cart.show");
    Route::get('carts/update/{rowId}/{qty}', CartController::class . "@update")->name("cart.update");
    Route::get('carts/delete/{rowId}', CartController::class . "@delete")->name("cart.delete");
    Route::get('carts/discount', CartController::class . "@discount")->name("cart.discount");

    Route::get('payment/checkout', PaymentController::class . "@create")->name("payment.create");
    Route::post('payment/store', PaymentController::class . "@store")->name("payment.store");
    Route::get('address/{provinceId}/districts', AddressController::class . "@districts");
    Route::get('address/{districtId}/wards', AddressController::class . "@wards");
    Route::get('shippingfee/{province_id}', AddressController::class . "@shippingFee");

// });

Route::middleware("auth")->group(function() {
    Route::get('customer/show', CustomerController::class . "@show")->name("customer.show");
    Route::post('customer/update', CustomerController::class . "@update")->name("customer.update");
    Route::get('customer/address', CustomerController::class . "@address")->name("customer.address");
    Route::post('customer/updateAddress', CustomerController::class . "@updateAddress")->name("customer.address.update");
    Route::get('orders', OrderController::class . "@index")->name("customer.orders");
    Route::get('orders/{orderId}', OrderController::class . "@show")->name("customer.order.detail");
});