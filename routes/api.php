<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FlavourController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
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




// Route::get('item', [TodoController::class, 'index']);
// Route::get('edit/{id}', [TodoController::class, 'edit']);
// Route::put('update/{id}', [TodoController::class, 'update']);
// Route::post('store', [TodoController::class, 'store']);
// Route::delete('delete/{id}', [TodoController::class, 'destroy']);


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:api')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
    Route::get('/all', [AuthController::class, 'all']);

    Route::post('/order', [OrderController::class, 'order']);
    Route::get('/order-item', [OrderController::class, 'orderItem']);
    Route::get('/order-delete/{id}', [OrderController::class, 'orderDelete']);

    Route::post('/user-update/{id}', [AuthController::class, 'update']);

    Route::post('/items/store', [FlavourController::class, 'itemStore']);
    Route::get('/items/get', [FlavourController::class, 'itemGet']);
    Route::get('/items/{id}', [FlavourController::class, 'show']);
    Route::get('/items/delete/{id}', [FlavourController::class, 'delete']);
    Route::get('/single/items/{id}', [FlavourController::class, 'single']);
    Route::post('/update/items/{id}', [FlavourController::class, 'update']);

    Route::post('/items/status', [FlavourController::class, 'itemStatus']);
});
Route::get('/login', [UserController::class, 'login'])->name('login');

Route::get('/all/items', [FlavourController::class, 'allItemGet']);
