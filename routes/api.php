<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomtypeController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::post('/add', [UserController::class, 'user']);
Route::get('/users', [UserController::class, 'index']); // Fetch all users
Route::get('/users/{id}', [UserController::class, 'show']); // Fetch a single user
Route::put('/users/{id}', [UserController::class, 'update']); // Update a user
Route::delete('/users/{id}', [UserController::class, 'destroy']); // Delete a user

// routes/api.php

Route::get('/customers', [CustomerController::class, 'index']);
Route::post('/customers', [CustomerController::class, 'store']);
Route::post('/api/edit/{id}', [UserController::class, 'update']);
Route::put('/customers/{id}', [CustomerController::class, 'update']);
Route::delete('/customers/{id}', [CustomerController::class, 'destroy']);
// In routes/api.php

Route::get('/rooms', [RoomController::class, 'index']);
Route::post('/rooms', [RoomController::class, 'store']);
Route::get('/rooms/{room}', [RoomController::class, 'show']);
Route::put('/rooms/{room}', [RoomController::class, 'update']);
Route::delete('/rooms/{room}', [RoomController::class, 'destroy']);

// In routes/api.php
Route::get('/roomtypes', [RoomtypeController::class, 'index']);
Route::post('/roomtypes', [RoomtypeController::class, 'store']);
Route::get('/roomtypes/{roomtype}', [RoomtypeController::class, 'show']);
Route::put('/roomtypes/{roomtype}', [RoomtypeController::class, 'update']);
Route::delete('/roomtypes/{roomtype}', [RoomtypeController::class, 'destroy']);

