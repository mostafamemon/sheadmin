<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Category;
use App\Http\Livewire\SubCategory;
use App\Http\Livewire\Product;

Route::get('/',Dashboard::class);
Route::get('/category/{current_page?}/{category_id?}',Category::class);
Route::get('/sub-category/{current_page?}/{sub_category_id?}',SubCategory::class);
Route::get('/product/{current_page?}/{product_id?}',Product::class);
