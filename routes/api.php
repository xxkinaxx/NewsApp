<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
    Route::put('/update_password', [App\Http\Controllers\API\AuthController::class, 'updatePassword']);
    Route::post('/create_profile', [App\Http\Controllers\API\AuthController::class, 'storeProfile']);
    Route::post('/update_profile', [App\Http\Controllers\API\AuthController::class, 'updateProfile']);
});

// Route Admin
Route::group(['middleware' => ['auth:sanctum', 'admin']], function(){
    Route::post('/category/create', [App\Http\Controllers\API\CategoryController::class, 'store']);
    Route::post('/category/update/{id}', [App\Http\Controllers\API\CategoryController::class, 'update']);
    Route::delete('/category/delete/{id}', [App\Http\Controllers\API\CategoryController::class, 'destroy']);
    Route::post('/news/create', [App\Http\Controllers\API\NewsController::class, 'store']);
    Route::delete('/news/delete/{id}', [App\Http\Controllers\API\NewsController::class, 'destroy']);
    Route::post('/news/update/{id}', [App\Http\Controllers\API\NewsController::class, 'update']);
});

Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);
Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register']);
Route::get('/allUsers', [App\Http\Controllers\API\AuthController::class, 'allUsers']);
// get data news
Route::get('/allNews', [App\Http\Controllers\API\NewsController::class, 'index']);
// get data news by id
Route::get('/news/{id}', [App\Http\Controllers\API\NewsController::class, 'show']);
// get data category
Route::get('/allCategory', [App\Http\Controllers\API\CategoryController::class, 'index']);
Route::get('/category/{id}', [App\Http\Controllers\API\CategoryController::class, 'show']);
// get data slider
Route::get('/slider', [App\Http\Controllers\API\FrontEndController::class, 'index']);
