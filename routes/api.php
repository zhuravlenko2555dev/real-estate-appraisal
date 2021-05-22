<?php

use App\Http\Controllers\RealEstateController;
use App\Http\Controllers\UserController;
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

Route::prefix('auth')->group(function () {
    Route::post('login', [UserController::class, 'login']);
    Route::post('register', [UserController::class, 'register']);

    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::post('refreshToken', [UserController::class, 'refreshToken']);
        Route::post('logout', [UserController::class, 'logout']);
        Route::get('user', [UserController::class, 'user']);
    });
});
Route::post('real_estates/appraise/{real_estate}', [RealEstateController::class, 'appraise'])->middleware('auth:sanctum');
Route::resource('real_estates', RealEstateController::class)->middleware('auth:sanctum');
