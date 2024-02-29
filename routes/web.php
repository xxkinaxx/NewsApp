<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\NewsController;
use App\Http\Controllers\HomeController;
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
    // routes for admin
    Route::middleware(['auth',  'admin'])->group(function(){
        Route::resource('news', NewsController::class);

        Route::resource('category', CategoryController::class)->middleware('auth');
    });
});