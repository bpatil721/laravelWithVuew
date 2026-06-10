<?php

use Illuminate\Support\Facades\Route;
use Modules\Frontend\Http\Controllers\FrontendController;

Route::resource('/', FrontendController::class)->names('frontend');

Route::middleware(['auth'])->group(function () {
     Route::get('/checkout',[FrontendController::class,'getCheckout']);
});
