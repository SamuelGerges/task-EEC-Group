<?php

use Illuminate\Support\Facades\Route;

Route::get('/',function (){
    return view('site.index');
});

Route::group([
    'prefix' => 'pharmacies',
],function (){
    Route::get('/',[\App\Http\Controllers\Site\PharmacyController::class,'index'])->name('pharmacies.index');
    Route::get('create',[\App\Http\Controllers\Site\PharmacyController::class,'create'])->name('pharmacies.create');
    Route::post('store',[\App\Http\Controllers\Site\PharmacyController::class,'store'])->name('pharmacies.store');
    Route::get('edit/{id}',[\App\Http\Controllers\Site\PharmacyController::class,'edit'])->name('pharmacies.edit');
    Route::post('update/{id}',[\App\Http\Controllers\Site\PharmacyController::class,'update'])->name('pharmacies.update');
    Route::get('delete/{id}',[\App\Http\Controllers\Site\PharmacyController::class,'delete'])->name('pharmacies.delete');

    Route::get('products-by-pharmacy/{id}',[\App\Http\Controllers\Site\PharmacyController::class,'showProductsByPharmacyId'])
        ->name('pharmacies.showProductsByPharmacyId');



});


Route::group([
    'prefix' => 'products',
],function (){
    Route::get('/',[\App\Http\Controllers\Site\ProductController::class,'index'])->name('products.index');
    Route::get('create',[\App\Http\Controllers\Site\ProductController::class,'create'])->name('products.create');
    Route::post('store',[\App\Http\Controllers\Site\ProductController::class,'store'])->name('products.store');
    Route::get('edit/{productId}',[\App\Http\Controllers\Site\ProductController::class,'edit'])
        ->name('products.edit')
        ->whereNumber('productId');
    Route::post('update/{productId}',[\App\Http\Controllers\Site\ProductController::class,'update'])
        ->name('products.update')
        ->whereNumber('productId');

    Route::get('delete/{id}',[\App\Http\Controllers\Site\ProductController::class,'delete'])
        ->name('products.delete')
        ->whereNumber('id');



    Route::get('get-details/{id}',[\App\Http\Controllers\Site\ProductController::class,'getDetailsForProduct'])
        ->name('products.getDetailsForProduct');


});

Route::group([
    'prefix' => 'pharmacy',
], function (){
    Route::get('{pharmacyId}/add-product',[\App\Http\Controllers\Site\PharmacyProductController::class,'addProductToPharmacy'])
        ->name('pharmacy.add.product')
        ->whereNumber('pharmacyId');

    Route::post('{pharmacyId}/store-product', [\App\Http\Controllers\Site\PharmacyProductController::class, 'storePharmacyProduct'])
        ->name('pharmacy.store.product')
        ->whereNumber('pharmacyId');

    Route::get('search-product-select2', [\App\Http\Controllers\Site\PharmacyProductController::class, 'searchProductSelect2'])
        ->name('search.products.select2');

    Route::get('edit-product/{IdInPharmacyProduct}', [\App\Http\Controllers\Site\PharmacyProductController::class, 'edit'])
        ->name('editProductInPharmacy')
        ->whereNumber('IdInPharmacyProduct');

    Route::post('update-product-in-pharmacy/{IdInPharmacyProduct}', [\App\Http\Controllers\Site\PharmacyProductController::class, 'update'])
        ->name('pharmacy.updateForProduct')
        ->whereNumber('IdInPharmacyProduct');


    Route::get('delete/{productId}', [\App\Http\Controllers\Site\PharmacyProductController::class, 'delete'])
        ->name('pharmacy.deleteProductInPharmacy')
        ->whereNumber('productId');

});
