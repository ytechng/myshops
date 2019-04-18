<?php

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

/**
 * Front Route
 **/
Route::get('/', 'PagesController@homePage');
Route::get('/home', 'PagesController@homePage');
Route::get('/index', 'PagesController@homePage');
Route::get('/home', 'HomeController@index')->name('home');

/**
 * Cart Route
 **/
Route::match(['get', 'post'], '/add-cart', 'CartsController@addToCart');
Route::match(['get', 'post'], '/cart', 'CartsController@cart');
Route::get('/cart/delete/{id}', 'CartsController@removeCart');
Route::get('/cart/update/{id}/{qty}', 'CartsController@updateCart');
//Route::get('/cart/update/remove/{id}', 'CartsController@updateMinusCart');

/**
 * Apply Coupon
 */
Route::post('/cart/apply-coupon/', 'CartsController@applyCoupon');

// Product category listing by category url
Route::get('/products/{url}', 'ProductController@getProducts');

// Get product details by product id
Route::get('/product/{id}', 'ProductController@getProduct');

// Get product attribute api
Route::get('/get-product-attribute', 'ProductController@getProductAttribute');

Route::match(['get', 'post'], '/admin', 'AdminController@login');

Auth::routes();

Route::get('/logout', 'AdminController@logout');

//Route::group(['middleware' => ['auth']], function () {
/**
 * Admin Route
 **/
Route::get('/admin/dashboard', 'AdminController@dashboard');
Route::get('/admin/setting', 'AdminController@setting');
Route::get('/admin/check-password', 'AdminController@checkPassword');
Route::match(['get', 'post'], '/admin/update-password', 'AdminController@updatePassword');

/**
 * Categories Route
 **/
Route::get('/admin/categories', 'CategoryController@categories');
Route::match(['get', 'post'], '/admin/categories/add', 'CategoryController@addCategory');
// /Route::match(['get', 'post'], '/admin/categories/edit/{id}', 'CategoryController@editCategory');
Route::match(['get', 'post'], '/admin/categories/edit/{id}/{pid}/{name}/{desc}/{url}', 'CategoryController@editCategory');
Route::match(['get', 'post'], '/admin/categories/delete/{id}', 'CategoryController@deleteCategory');
Route::get('/admin/categories/loadCategoryTable', 'CategoryController@loadCategoryTable');

/**
 * Products Route
 **/
Route::get('/admin/products', 'ProductController@products');
Route::match(['get', 'post'], '/admin/products/add', 'ProductController@addProduct');
Route::match(['get', 'post'], '/admin/products/edit/{id}', 'ProductController@editProduct');
Route::get('/admin/products/delete/{id}', 'ProductController@deleteProduct');
Route::get('admin/products/delete/image/{id}', 'ProductController@deleteImage');
Route::get('admin/products/delete/alternate-image/{id}', 'ProductController@deleteAlternateImage');

/**
 * Products Attributes Route
 **/
Route::match(['get', 'post'], '/admin/products/add-attributes/{id}', 'ProductController@addAttributes');
//Route::match(['get', 'post'], '/admin/products/edit-attributes/{id}', 'ProductController@editAttributes');
Route::get('/admin/products/edit-attributes/{id}/{qty}/{price}', 'ProductController@editAttributesJS');
Route::match(['get', 'post'], '/admin/products/add-images/{id}', 'ProductController@addImages');
Route::get('/admin/products/delete-attribute/{id}', 'ProductController@deleteAttribute');
//});

/**
 * Coupon Route
 **/
Route::get('/admin/coupons', 'CouponsController@coupons');
Route::match(['get', 'post'], '/admin/coupons/add', 'CouponsController@addCoupon');
Route::get('/admin/coupons/edit/{code}/{amount}/{type}/{sdate}/{edate}', 'CouponsController@editCoupon');
Route::get('/admin/coupons/delete/{code}', 'CouponsController@deleteCoupon');

/**
 * Banner Route
 **/
Route::get('/admin/banners', 'BannersController@banners');
Route::match(['get', 'post'], '/admin/banners/add', 'BannersController@addBanner');
Route::match(['get', 'post'], '/admin/banners/edit/', 'BannersController@editBanner');
Route::get('/admin/banners/delete/{id}', 'BannersController@deleteBanner');


/**
 * Users Route
 **/
// Login Or Register
 Route::match(['get', 'post'], '/users/login-register', 'UsersController@registerOrLogin');

 // Check If User Email Already Exist
 Route::match(['get', 'post'], '/users/check-email', 'UsersController@checkEmail');
