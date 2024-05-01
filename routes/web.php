<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\NewsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Profile\ProfileController;
use Illuminate\Support\Facades\Artisan;
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

Route::get('/', [App\Http\Controllers\frontend\FrontendController::class, 'index']);
Route::get('/detail/news/{slug}', [App\Http\Controllers\frontend\FrontendController::class, 'detailNews'])->name('detailNews');
Route::get('/detail/category/{slug}', [App\Http\Controllers\frontend\FrontendController::class, 'detailCategory'])->name('detailCategory');

Auth::routes();

// handle redirect register to login
// Route::match(['get', 'post'], '/register', function () {
//     return redirect('/login');
// });

// route middleware
Route::middleware('auth')->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/profile', [App\Http\Controllers\Profile\ProfileController::class, 'index'])->name('profile.index');
    Route::get('/change', [App\Http\Controllers\Profile\ProfileController::class, 'changePassword'])->name('profile.change-password');
    Route::put('/update-password', [App\Http\Controllers\Profile\ProfileController::class, 'updatePassword'])->name('profile.update-password');
    Route::get('/create-profile', [App\Http\Controllers\Profile\ProfileController::class, 'createProfile'])->name('profile.create-profile');
    Route::post('/store-profile', [App\Http\Controllers\Profile\ProfileController::class, 'storeProfile'])->name('profile.store-profile');
    Route::get('/edit-profile', [App\Http\Controllers\Profile\ProfileController::class, 'editProfile'])->name('profile.edit-profile');
    Route::put('/update-profile', [App\Http\Controllers\Profile\ProfileController::class, 'updateProfile'])->name('profile.update-profile');
    // routes for admin
    Route::middleware(['auth',  'admin'])->group(function(){
        Route::resource('news', NewsController::class);

        // fungsi except untuk menghilangkan 1 fungsi
        // fungsi only untuk menampilkan hanya 1 fungsi
        Route::resource('category', CategoryController::class)->middleware('auth')->except('show');
        // get all user
        Route::get('/all-user', [App\Http\Controllers\Profile\ProfileController::class, 'allUser'])->name('allUser');
        // reset password
        Route::put('/reset-password/{id}', [App\Http\Controllers\Profile\ProfileController::class, 'resetPassword'])->name('resetPassword');
    });
});

// storage link
Route::get('/storage-link', function(){
    Artisan::call('storage:link');
    return 'success';
});

// config cache
Route::get('/config-cache', function(){
    Artisan::call('config:cache');
    return 'config:cache berhasil dijalankan';
});

// config clear
Route::get('/config-clear', function(){
    Artisan::call('config:clear');
    return 'config:clear berhasil dijalankan';
});

// view clear
Route::get('/view-clear', function(){
    Artisan::call('view:clear');
    return 'view:clear berhasil dijalankan';
});

// view cache
Route::get('/view-cache', function(){
    Artisan::call('view:cache');
    return 'view:cache berhasil dijalankan';
});

// route clear
Route::get('/route-clear', function(){
    Artisan::call('route:clear');
    return 'route:clear berhasil dijalankan';
});

// route cache
Route::get('/route-cache', function(){
    Artisan::call('route:cache');
    return 'route:cache berhasil dijalankan';
});