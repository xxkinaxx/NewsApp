<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\NewsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Profile\ProfileController;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes();

// handle redirect register to login
Route::match(['get', 'post'], '/register', function () {
    return redirect('/login');
});

// route middleware
Route::middleware('auth')->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/profile', [App\Http\Controllers\Profile\ProfileController::class, 'index'])->name('profile.index');
    Route::get('/change', [App\Http\Controllers\Profile\ProfileController::class, 'changePassword'])->name('profile.change-password');
    Route::put('/update-password', [App\Http\Controllers\Profile\ProfileController::class, 'updatePassword'])->name('profile.update-password');
    // routes for admin
    Route::middleware(['auth',  'admin'])->group(function(){
        Route::resource('news', NewsController::class);

        // fungsi except untuk menghilangkan 1 fungsi
        // fungsi only untuk menampilkan hanya 1 fungsi
        Route::resource('category', CategoryController::class)->middleware('auth')->except('show');
    });
});