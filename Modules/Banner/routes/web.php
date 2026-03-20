<?php

use Illuminate\Support\Facades\Route;
use Modules\Banner\Http\Controllers\BannerController;

Route::resource('banners', BannerController::class)->names('banner');
Route::middleware(['auth', 'verified'])->group(function () {
});
