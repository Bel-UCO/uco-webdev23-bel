<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/products')->controller(ProductController::class)->group(function () {
    Route::get('/', 'index')->name('products.list');
    Route::get('/create', 'create')->name('products.form');
    Route::get('/edit/{id}', 'edit')->name('products.edit');
    Route::post('/store', 'store')->name('products.store');
    Route::post('/update/{id}', 'update')->name('products.update');
    Route::get('/show/{id}', 'show')->name('products.show');
    Route::get('/show/{id}/image1','image1')->name('products.image1');
    Route::get('/show/{id}/image2','image2')->name('products.image2');
    Route::get('/show/{id}/image3','image3')->name('products.image3');
    Route::get('/search', 'search')->name('products.search');
    Route::get('/filter', 'fliter')->name('products.filter');
});

Route::prefix('/categories')->controller(CategoryController::class)->group(function() {
	Route::get('/', 'index')->name('categories.list');
	Route::get('/create', 'create')->name('categories.create');
	Route::post('/store', 'store')->name('categories.store');
	Route::get('/edit/{id}', 'edit')->name('categories.edit');
	Route::post('/update/{id}', 'update')->name('categories.update');
	Route::post('/destroy/{id}', 'destroy')->name('categories.destroy');
});
