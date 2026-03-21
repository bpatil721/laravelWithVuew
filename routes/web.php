<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\DashboardController;
use Modules\Post\Http\Controllers\PostController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\ChangePasswordController;
use Modules\Banner\Http\Controllers\BannerController;
use Modules\Product\Http\Controllers\ProductController;




Route::get('/posts', [PostController::class, 'postIndex'])->name('posts.index');
Route::get('/posts-demo', [PostController::class, 'postIndexDemo'])->name('posts.index1');
Route::get('user/dashboard', [DashboardController::class, 'dashboard'])->name('user.dashboard');
Route::get('/get-collection', [BannerController::class, 'getCollection']);
Route::get('product/{id}', [ProductController::class,'show']);

// Profile routes (require authentication)
Route::middleware('auth')->group(function () {
    Route::get('user/profile', [ProfileController::class, 'index'])->name('user.profile');
    Route::put('user/profile', [ProfileController::class, 'update'])->name('user.profile.update');
    Route::put('user/profile/password', [ProfileController::class, 'updatePassword'])->name('user.profile.password');
    route::post('user/change-password',[ProfileController::class,'changePassword'])->name('user.change-password');
});


require __DIR__.'/auth.php';