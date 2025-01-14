<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\RegistrationController;

Route::get('/', function () {
    return view('home', ['showFilters' => false]);
})->name('home');

Route::prefix('/products')->controller(ProductController::class)->group(function () {
    Route::get('/', 'index')->name('products.list');
    Route::get('/create', 'create')->name('products.form')->middleware('can:is-admin');
    Route::get('/edit/{id}', 'edit')->name('products.edit')->middleware('can:is-admin');
    Route::post('/store', 'store')->name('products.store')->middleware('can:is-admin');
    Route::post('/update/{id}', 'update')->name('products.update')->middleware('can:is-admin');
    Route::get('/show/{id}', 'show')->name('products.show');
    Route::get('/show/{id}/image1','image1')->name('products.image1');
    Route::get('/show/{id}/image2','image2')->name('products.image2');
    Route::get('/show/{id}/image3','image3')->name('products.image3');
    Route::get('/search', 'search')->name('products.search');
    Route::get('/filter', 'filter')->name('products.filter');
});

Route::prefix('/categories')->controller(CategoryController::class)->middleware('can:is-admin')->group(function() {
	Route::get('/', 'index')->name('categories.list');
	Route::get('/create', 'create')->name('categories.create');
	Route::post('/store', 'store')->name('categories.store');
	Route::get('/edit/{id}', 'edit')->name('categories.edit');
	Route::post('/update/{id}', 'update')->name('categories.update');
	Route::post('/destroy/{id}', 'destroy')->name('categories.destroy');
});

Route::prefix('/registration')->controller(RegistrationController::class)->middleware('guest')->group(function() {
    Route::get('/', 'index')->name('registration');
	Route::post('/store', 'store')->name('registration.store');
});

Route::prefix('/login')->controller(LoginController::class)->middleware('guest')->group(function() {
    Route::get('/', 'index')->name('login');
	Route::post('/store', 'store')->name('login.store');
});

Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth')->name('logout');

Route::prefix('/cart')->controller(CartController::class)->middleware('can:is-user')->group(function() {
    Route::get('/', 'index')->name('cart.list');
    Route::get('/checkout', 'checkout')->name('cart.checkout');
    Route::post('/add', 'add')->name('cart.add');
    Route::post('/update', 'update')->name('cart.update');
    Route::post('/delete',  'destroy')->name('cart.delete');
    Route::post('/payment', 'payment')->name('cart.payment');
    Route::view('/succeed', 'cart.succeed')->name('cart.succeed');
    Route::post('/update-quantity', 'updateQuantitywithButton')->name('cart.updateQuantity');
});

Route::get('/purchase/history', [PurchaseController::class, 'history'])->middleware('can:is-user')->name('purchase.history');

Route::get('/admin', function(){
    return view('admin.home', ['showFilters' => false]);})->middleware('can:is-admin')->name('admin.home');

