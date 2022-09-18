<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
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
    return view('auth.login');
});
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'handle'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'handle'])->name('register');

Route::middleware('auth:web')->group(function () {
    Route::post('/create-new-user', [UserController::class], 'registerNewUser');
    Route::put('/update-user', [UserController::class], 'updateExistingUser');
    Route::get('/show-user/{id}', [UserController::class], 'showUserInformation');
    Route::post('/delete-user/{id}', [UserController::class], 'destroyUser');

    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});
