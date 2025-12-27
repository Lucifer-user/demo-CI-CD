<?php

use App\Http\Controllers\CategoryProduct;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\SigupController;
use App\Http\Controllers\CategoryAttributeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\labController;

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
//fondend

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/trangchu', [HomeController::class, 'index'])->name('trangchu');
Route::get('/sanpham', [HomeController::class, 'product'])->name('sanpham');

//danh mục sản phẩm trang chủ
Route::get('/danh-muc-san-pham/{category_id}', [HomeController::class, 'product'])->name('category_home');
//thương hiệu sản phẩm
Route::get('/thuong-hieu-san-pham/{brand_id}', [HomeController::class, 'show_brand_home'])->name('brand_home');
//tìm kiếm
Route::post('/tim-kiem', [HomeController::class, 'search'])->name('search');
//chi tiết sản phẩm
Route::get('/chi-tiet-san-pham/{product_id}', [SanPhamController::class, 'product_details'])->name('product_details');
//cập nhật số lượng
Route::post('/update-cart-quantity', [CartController::class, 'update_cart_quantity'])->name('update_cart_quantity');
//backend
Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::post('/admin', [AdminController::class, 'dashboard'])->name('admin-dashboard');
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::get('/dashboard', [AdminController::class, 'show_dashboard'])->middleware('admin.auth')->name('dashboard');


//Category product
Route::get('/admin/category_product', [CategoryProduct::class, 'add_category'])->middleware('admin.auth')->name('admin.add_category');
Route::get('/admin/all-category-product', [CategoryProduct::class, 'all_category_product'])->middleware('admin.auth')->name('admin.all_category_product');
Route::post('/admin/save_category', [CategoryProduct::class, 'save_category'])->middleware('admin.auth')->name('save_category');
Route::get('/edit-category-product/{category_product_id}', [CategoryProduct::class, 'edit_category_product'])->middleware('admin.auth');
Route::post('/update-category-product/{category_product_id}', [CategoryProduct::class, 'update_category_product'])->middleware('admin.auth');
Route::get('/delete-category-product/{category_product_id}', [CategoryProduct::class, 'delete_category_product'])->middleware('admin.auth');

//brand
Route::get('/admin/add_brand', [BrandController::class, 'add_brand'])->middleware('admin.auth')->name('admin.add_brand');
Route::get('/admin/all-brand', [BrandController::class, 'all_brand'])->middleware('admin.auth')->name('admin.all_brand');
Route::post('/admin/save_brand', [BrandController::class, 'save_brand'])->middleware('admin.auth')->name('save_brand');
Route::get('/edit-brand/{brand_id}', [BrandController::class, 'edit_brand'])->middleware('admin.auth');
Route::post('/update-brand/{brand_id}', [BrandController::class, 'update_brand'])->middleware('admin.auth');
Route::get('/delete-brand/{brand_id}', [BrandController::class, 'delete_brand'])->middleware('admin.auth');


//Sản phẩm
Route::get('/admin/add_sanpham', [SanPhamController::class, 'add_sanpham'])->middleware('admin.auth')->name('admin.add_sanpham');
Route::get('/admin/all_sanpham', [SanPhamController::class, 'all_sanpham'])->middleware('admin.auth')->name('admin.all_sanpham');
Route::post('/admin/save_sanpham', [SanPhamController::class, 'save_sanpham'])->middleware('admin.auth')->name('save_sanpham');
Route::get('/edit-sanpham/{sanpham_id}', [SanPhamController::class, 'edit_sanpham'])->middleware('admin.auth');
Route::post('/update-sanpham/{sanpham_id}', [SanPhamController::class, 'update_sanpham'])->middleware('admin.auth');
Route::get('/delete-sanpham/{sanpham_id}', [SanPhamController::class, 'delete_sanpham'])->middleware('admin.auth');
Route::get('/active-sanpham/{sanpham_id}', [SanPhamController::class, 'active_sanpham'])->middleware('admin.auth');
Route::get('/unactive-sanpham/{sanpham_id}', [SanPhamController::class, 'unactive_sanpham'])->middleware('admin.auth');


//giỏ hàng
Route::post('/save-cart', [CartController::class, 'save_cart'])->name('save_cart');
Route::get('/show_cart', [CartController::class, 'show_cart'])->name('show_cart');
Route::get('/delete-to-cart/{rowId}', [CartController::class, 'delete_to_cart']);

//check out
Route::get('/login-checkout', [CheckOutController::class, 'login_checkout'])->name('login_checkout');
Route::post('/login-customer', [CheckOutController::class, 'login_customer'])->name('login_customer');
Route::post('/add_customer', [CheckOutController::class, 'add_customer'])->name('add_customer');
Route::get('/checkout', [CheckOutController::class, 'checkout'])->name('checkout');
Route::post('/save-checkout-customer', [CheckOutController::class, 'save_checkout'])->name('save_checkout');
Route::get('/payment', [CheckOutController::class, 'payment'])->name('payment');
Route::post('/order-place', [CheckOutController::class, 'order_place'])->name('order_place');
Route::post('/select-address', [CheckOutController::class, 'select_address'])->name('select_address');
Route::get('/logout-checkout', [CheckOutController::class, 'logout_checkout'])->name('logout_checkout');
//sigup
Route::get('/sigup', [SigupController::class, 'sigup'])->name('sigup');


// Category Attributes
Route::get('/admin/category-attributes', [CategoryAttributeController::class, 'index'])->middleware('admin.auth')->name('admin.category_attributes');
Route::post('/admin/save-category-attribute', [CategoryAttributeController::class, 'store'])->middleware('admin.auth')->name('admin.category_attributes.store');
Route::get('/edit-category-attribute/{id}', [CategoryAttributeController::class, 'edit'])->middleware('admin.auth')->name('admin.category_attributes.edit');
Route::post('/update-category-attribute/{id}', [CategoryAttributeController::class, 'update'])->middleware('admin.auth')->name('admin.category_attributes.update');
Route::get('/delete-category-attribute/{id}', [CategoryAttributeController::class, 'destroy'])->middleware('admin.auth')->name('admin.category_attributes.delete');
// API for AJAX
Route::get('/api/category-attributes/{category_id}', [CategoryAttributeController::class, 'getAttributesByCategory']);
Route::get('/api/product-attributes/{product_id}', [CategoryAttributeController::class, 'getProductAttributes']);


//đơn hàng
Route::get('/admin/manage_order', [OrderController::class, 'manage_order'])->middleware('admin.auth')->name('admin.manage_order');
Route::get('/view-order/{orderId}',[OrderController::class,'view_order'])->middleware('admin.auth')->name('view_order');
Route::get('/delete-order/{orderId}',[OrderController::class,'delete_order'])->middleware('admin.auth')->name('delete_order');


//lab thực hành
Route::get('/lab', [labController::class, 'index'])->name('lab');
Route::get('/lab/{lab_id}', [labController::class, 'show'])->name('lab.show');

