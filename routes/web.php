<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Category;
use App\Http\Livewire\SubCategory;
use App\Http\Livewire\Product;
use App\Http\Livewire\Banner;
use App\Http\Livewire\TextContent;
use App\Http\Livewire\Login;

Route::get('/login',Login::class)->name('login');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/',Dashboard::class);
    Route::get('/dashboard',Dashboard::class);
    Route::get('/category/{current_page?}/{category_id?}',Category::class);
    Route::get('/sub-category/{current_page?}/{sub_category_id?}',SubCategory::class);
    Route::get('/product/{current_page?}/{product_id?}',Product::class);
    Route::get('/banner',Banner::class);
    Route::get('/text-content',TextContent::class);
});

