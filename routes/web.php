<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

require __DIR__ . '/auth.php';


use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Frontendcontroller;
// use Illuminate\Support\Facades\Route;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

// Đăng nhập / đăng ký Admin
Route::get('/login', [AccountController::class, 'login'])->name('login');
Route::post('/check_login', [AccountController::class, 'check_login']);
//register admin
Route::get('/register', [AccountController::class, 'show'])->name('register');
Route::post('/register', [AccountController::class, 'store'])->name('register.store');
//admin
Route::middleware('auth')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', function () {
            return view('admin.home');
        });
        Route::get('product/list', [ProductController::class, 'list_product'])->name('admin.product.list');
    });
});
// Đăng nhập / đăng ký khách hàng
Route::get('/account/login', [FrontendController::class, 'login'])->name('account_login');
Route::post('/account/check_login', [FrontendController::class, 'check_login'])->name('account_check_login');

Route::get('/account/register', [FrontendController::class, 'show'])->name('account_register');
Route::post('/account/register', [FrontendController::class, 'store'])->name('account_register.store');
//logout
Route::get('/account/logout', [FrontendController::class, 'logout'])->name('account_logout');
//user
// Route::get('/account/user', [Frontendcontroller::class, 'show_user']);
Route::get('/edit/account', [FrontendController::class, 'edit_user'])->name('edit_user');
Route::post('/update/account', [FrontendController::class, 'update_user'])->name('update_user');
// Trang khách hàng sau khi đăng nhập
Route::middleware('auth:customer')->group(function () {
    Route::prefix('/')->group(function () {
        Route::get('/', function () {
            return view('home');
        })->name('home');
    });
});
//logout
Route::post('/logout', [Frontendcontroller::class, 'logout'])->name('logout_user');
//backend
Route::post('/admin/product/add', [ProductController::class, 'insert_product']);
Route::get('/admin/product/create', [ProductController::class, 'add_product']);
Route::post('/admin/product/delete', [ProductController::class, 'delete_product'])->name('admin.product.delete');
// Route hiển thị form chỉnh sửa (GET)
Route::get('/admin/product/edit/{id}', [ProductController::class, 'edit_product'])->name('admin.product.edit');
// Route xử lý cập nhật (POST)
Route::post('/admin/product/edit', [ProductController::class, 'update_product'])->name('admin.product.update');


//Order
Route::get('/admin/order/list', [OrderController::class, 'order_list']);
Route::get('admin/order/detail/{order_detail}', [OrderController::class, 'order_detail']);
//upload
Route::post('/upload', [UploadController::class, 'uploadImage']);
Route::post('/uploads', [UploadController::class, 'uploadImages']);



//////////
//frontend
//////////
// Route::get('/', [Frontendcontroller::class, 'index']);
Route::get('/frontend/product/{id}', [Frontendcontroller::class, 'show_product']);


// Route::get('/frontend/order/order_check', [Frontendcontroller::class, 'order_check']);
Route::get('/frontend/order/order_check/{id}', [Frontendcontroller::class, 'order_check']);
Route::get('/frontend/order/order_success', function () {
    return view('frontend.order.order_success');
});
//Cart
Route::post('/cart/add', [Frontendcontroller::class, 'add_cart']);
Route::post('/cart/update-ajax', [Frontendcontroller::class, 'cart_update_ajax']);

Route::get('/frontend/cart', [Frontendcontroller::class, 'show_cart']);
Route::get('/cart/delete/{id}', [Frontendcontroller::class, 'cart_delete']);
Route::post('/cart/update', [Frontendcontroller::class, 'cart_update']);
Route::post('/cart/send', [Frontendcontroller::class, 'cart_send']);

//voucher
Route::post('/cart/apply-voucher', [Frontendcontroller::class, 'applyVoucher']);
