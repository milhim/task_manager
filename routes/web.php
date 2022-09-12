<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('admin.login');
});
Route::get('/login',[LoginController::class,'index'])->name('login.page');
Route::post('/login',[LoginController::class,'handle'])->name('login.process');
Route::get('/logout',[LoginController::class,'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'handle'])->name('register.process');


Route::get('/dashboard',[AdminController::class,'index'])->name('admin.dashboard');