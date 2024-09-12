<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\StoreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//register seller
Route::post('/seller/register', [AuthController::class, 'registerSeller']);
//login
Route::post('/login', [AuthController::class, 'login']);
//logout
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
//register buyer
Route::post('/buyer/register', [AuthController::class, 'registerBuyer']);




//store category
Route::post('/seller/category', [CategoryController::class, 'store'])->middleware('auth:sanctum');
//get all categories
Route::get('/seller/categories', [CategoryController::class, 'index'])->middleware('auth:sanctum');


//product resource
Route::apiResource('/seller/products', ProductController::class)->middleware('auth:sanctum');

//update product with post
Route::post('/seller/products/{id}', [ProductController::class, 'update'])->middleware('auth:sanctum');

//address resource
Route::apiResource('/buyer/addresses', AddressController::class)->middleware('auth:sanctum');

//order
Route::post('/buyer/orders', [OrderController::class, 'createOrder'])->middleware('auth:sanctum');

//store
Route::get('/buyer/stores', [StoreController::class, 'index'])->middleware('auth:sanctum');

//product by store
Route::get('/buyer/stores/{id}/products', [StoreController::class, 'productByStore'])->middleware('auth:sanctum');

//update shipping number
Route::put('/seller/orders/{id}/update-resi', [OrderController::class, 'updateShippingNumber'])->middleware('auth:sanctum');

//history order buyer
Route::get('/buyer/histories', [OrderController::class, 'historyOrderBuyer'])->middleware('auth:sanctum');

//history order seller
Route::get('/seller/orders', [OrderController::class, 'historyOrderSeller'])->middleware('auth:sanctum');

//get store is livestreaming
Route::get('/buyer/stores/livestreaming', [StoreController::class, 'livestreaming'])->middleware('auth:sanctum');
