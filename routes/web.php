<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
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

Route::get('/', [ HomeController::class, "index" ]);

Route::get('/search', [HomeController::class, 'search'])->name('search');

Route::get('/ajaxget', [HomeController::class, 'ajaxget'])->name('ajaxget');
Route::post('/ajaxpost', [HomeController::class, 'ajaxpost'])->name('ajaxpost');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login_auth');

    Route::get('/signup', [LoginController::class, 'signup_create'])->name('signup_create');
    Route::post('/signup', [LoginController::class, 'signup'])->name('signup');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/create', [HomeController::class, "create"])->name('create');
    Route::post('/create', [HomeController::class, "store"])->name('store');

    Route::get('/update', [HomeController::class, "edit"])->name('edit');
    Route::post('/update', [HomeController::class, "update"])->name('update');

    Route::delete('/{id}', [HomeController::class, "delete"])->name('delete');

    Route::get('/profile', [HomeController::class, "profile"])->name('profile');
});