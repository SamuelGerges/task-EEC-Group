<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::group([
    'prefix' => 'pharmacies',
],function (){
    Route::get('/{page?}',[\App\Http\Controllers\Api\PharmacyController::class, 'index']);
    Route::post('store',[\App\Http\Controllers\Api\PharmacyController::class, 'store']);
    Route::put('update/{id}',[\App\Http\Controllers\Api\PharmacyController::class, 'update']);
    Route::delete('delete/{id}',[\App\Http\Controllers\Api\PharmacyController::class, 'delete']);

    Route::get('products-by-pharmacy/{id}',[\App\Http\Controllers\Api\PharmacyController::class,'showProductsByPharmacyId']);


});

Route::group([
    'prefix' => 'products',
],function (){
    Route::get('/{page?}',[\App\Http\Controllers\Api\ProductController::class,'index']);
    Route::post('store',[\App\Http\Controllers\Api\ProductController::class, 'store']);
    Route::put('update/{productId}',[\App\Http\Controllers\Api\ProductController::class, 'update']);
    Route::delete('delete/{productId}',[\App\Http\Controllers\Api\ProductController::class, 'delete']);

    Route::get('get-details/{id}',[\App\Http\Controllers\Api\ProductController::class,'getDetailsForProduct']);

    Route::post('search',[\App\Http\Controllers\Api\ProductController::class, 'search']);


});

Route::group([
    'prefix' => 'pharmacy',
], function (){
    Route::post('{pharmacyId}/add-product',[\App\Http\Controllers\Api\PharmacyProductController::class,'storePharmacyProduct'])
        ->whereNumber('pharmacyId');

    Route::get('get-data-select2',[\App\Http\Controllers\Api\PharmacyProductController::class, 'getDataSelect2']);

    Route::put('update-product-in-pharmacy/{IdInPharmacyProduct}', [\App\Http\Controllers\Api\PharmacyProductController::class, 'update'])
        ->whereNumber('IdInPharmacyProduct');

    Route::delete('delete/{productId}', [\App\Http\Controllers\Api\PharmacyProductController::class, 'delete'])
        ->whereNumber('productId');
});
