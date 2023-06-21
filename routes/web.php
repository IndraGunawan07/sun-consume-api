<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

// Auth
Route::get('/register', function () {
    return view('auth/register');
});
Route::get('/login', function () {
    return view('auth/login');
});
Route::post('/login', [App\Http\Controllers\Auth::class, 'login']);
Route::post('/register', [App\Http\Controllers\Auth::class, 'register']);

Route::get('/dashboard', [App\Http\Controllers\Auth::class, 'dashboard']);

// Product
Route::get('/product', [App\Http\Controllers\Product\Product::class, 'index']);
Route::get('/product/create', [App\Http\Controllers\Product\Product::class, 'productCategoryList']);
Route::post('/product', [App\Http\Controllers\Product\Product::class, 'insert']);
Route::get('/product/{id}', [App\Http\Controllers\Product\Product::class, 'detail']);
Route::get('/product/{id}/pay', [App\Http\Controllers\Product\Product::class, 'pay']);
Route::put('/product/{id}', [App\Http\Controllers\Product\Product::class, 'update']);
Route::delete('/product/{id}', [App\Http\Controllers\Product\Product::class, 'delete']);

// Product Category
Route::get('/product-category', [App\Http\Controllers\Product\ProductCategory::class, 'index']);
Route::get('/product-category/create', function () {
    return view('productCategory/productCategoryInsert');
});
Route::post('/product-category', [App\Http\Controllers\Product\ProductCategory::class, 'insert']);
Route::get('/product-category/{id}', [App\Http\Controllers\Product\ProductCategory::class, 'detail']);
Route::put('/product-category/{id}', [App\Http\Controllers\Product\ProductCategory::class, 'update']);
Route::delete('/product-category/{id}', [App\Http\Controllers\Product\ProductCategory::class, 'delete']);




