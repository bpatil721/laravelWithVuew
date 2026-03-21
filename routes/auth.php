<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;




Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::get('/register', [LoginController::class, 'login'])->name('login');
Route::post('/post-login', [LoginController::class, 'postLogin'])->name('post-login');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/logout-user', [LoginController::class, 'logout'])->name('logout-user');

?>