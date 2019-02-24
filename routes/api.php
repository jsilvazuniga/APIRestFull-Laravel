<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
| listar routes:  php artisan route:list
*/

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

/** el nombre siempre en plural */
//Route::apiResource('users', 'UserController')->middleware('auth:api');
Route::apiResource('users', 'UserController')->middleware('auth:api');
Route::apiResource('products', 'Product\ProductController');
Route::apiResource('transactions', 'TransactionController')->middleware('auth:api');
Route::apiResource('categories', 'Category\CategoryController');

//solo exponer los metodos index y show 
Route::apiResource('buyers', 'BuyerController', ['only' => ['index', 'show']] );
Route::apiResource('sellers', 'Seller\SellerController', ['only' => ['index', 'show']]);

Route::apiResource('categories.transactions', 'Category\CategoryTransactionController', ['only' => ['index']]);
Route::apiResource('categories.buyers', 'Category\CategoryBuyerController', ['only' => ['index']]);
Route::apiResource('categories.products', 'Category\CategoryProductController', ['only' => ['index']]);
Route::apiResource('categories.sellers', 'Category\CategorySellerController', ['only' => ['index']]);

Route::apiResource('sellers.transactions', 'Seller\SellerTransactionController', ['only' => ['index']]);
Route::apiResource('sellers.categories', 'Seller\SellerCategoryController', ['only' => ['index']]);
Route::apiResource('sellers.buyers', 'Seller\SellerBuyerController', ['only' => ['index']]);
Route::apiResource('sellers.products', 'Seller\SellerProductController', ['except' => ['show']]);

Route::apiResource('products.transactions', 'Product\ProductTransactionController', ['only' => ['index']]);
Route::apiResource('products.buyers', 'Product\ProductBuyerController', ['only' => ['index']]);
Route::apiResource('products.categories', 'Product\ProductCategoryController', ['only' => ['index', 'update', 'destroy']]);

Route::apiResource('products.buyers.transactions', 'Product\ProductBuyerTransactionController', ['only' => ['store']]);

