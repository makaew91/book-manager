<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("login", [AuthController::class, 'login']);
Route::resource('users', UserController::class);
Route::resource('genres', GenreController::class);
//Route::resource('books', BookController::class);
Route::post('books/{id}', [BookController::class, 'store']);
Route::delete('books/{id}', [BookController::class, 'destroy']);
Route::get('books/{id}', [BookController::class, 'UserBooks']);
Route::get('book/{id}', [BookController::class, 'show']);
Route::patch('book/{id}', [BookController::class, 'update']);
