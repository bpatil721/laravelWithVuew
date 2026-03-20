<?php

use Illuminate\Support\Facades\Route;
use Modules\Category\Http\Controllers\CategoryController;

Route::resource('categories', CategoryController::class)->names('category');
Route::middleware(['auth', 'verified'])->group(function () {
});
