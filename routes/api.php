<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomtypeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\DashboardController;


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
// routes/api.php

Route::get('reports/expenses', [DashboardController::class, 'getExpenses']);
Route::get('reports/rents', [DashboardController::class, 'getRents']);
Route::get('reports/payments', [DashboardController::class, 'getPayments']);

Route::post('/login', [UserController::class, 'login']);
Route::get('/logout', [UserController::class, 'logout']);
// routes/api.php

Route::middleware('auth:api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});


Route::post('/add', [UserController::class, 'user']);
Route::get('/users', [UserController::class, 'index']); // Fetch all users
Route::get('/users/{id}', [UserController::class, 'show']); // Fetch a single user
Route::put('/users/{id}', [UserController::class, 'update']); // Update a user
Route::delete('/users/{id}', [UserController::class, 'destroy']); // Delete a user

// routes/api.php

Route::get('customers', [CustomerController::class, 'index']);
Route::post('customers', [CustomerController::class, 'store']);
Route::get('customers/{id}', [CustomerController::class, 'show']);
Route::put('customers/{id}', [CustomerController::class, 'update']);
Route::delete('customers/{id}', [CustomerController::class, 'destroy']);




// In routes/api.php

Route::get('/rooms', [RoomController::class, 'index']);
Route::post('/rooms', [RoomController::class, 'store']);
Route::get('/rooms/{room}', [RoomController::class, 'show']);
Route::put('/rooms/{room}', [RoomController::class, 'update']);
Route::delete('/rooms/{room}', [RoomController::class, 'destroy']);

Route::put('/rooms/status/{roomNumber}', [RoomController::class, 'updateStatus']);


// In routes/api.php
Route::get('/roomtypes', [RoomtypeController::class, 'index']);
Route::post('/roomtypes', [RoomtypeController::class, 'store']);
Route::get('/roomtypes/{roomtype}', [RoomtypeController::class, 'show']);
Route::put('/roomtypes/{roomtype}', [RoomtypeController::class, 'update']);
Route::delete('/roomtypes/{roomtype}', [RoomtypeController::class, 'destroy']);


Route::get('/bookings', [BookingController::class, 'index']);
Route::post('/bookings', [BookingController::class, 'store']);
Route::get('/bookings/{id}', [BookingController::class, 'show']);
Route::put('/bookings/{id}', [BookingController::class, 'update']);
Route::delete('/bookings/{id}', [BookingController::class, 'destroy']);


Route::get('/payments', [PaymentController::class, 'index']);
Route::post('/payments', [PaymentController::class, 'store']);
Route::get('/payments/{id}', [PaymentController::class, 'show']);
Route::put('/payments/{id}', [PaymentController::class, 'update']);
Route::delete('/payments/{id}', [PaymentController::class, 'destroy']);


// Route::apiResource('rents', RentController::class);
// use App\Http\Controllers\RentController;

Route::get('/rents', [RentController::class, 'index']);
Route::post('/rents', [RentController::class, 'store']);
Route::get('/rents/{id}', [RentController::class, 'show']);
Route::put('/rents/{id}', [RentController::class, 'update']);
Route::delete('/rents/{id}', [RentController::class, 'destroy']);
// api.php



// routes/api.php

Route::get('/checkouts', [CheckoutController::class, 'index']);
Route::post('/checkouts', [CheckoutController::class, 'store']);
Route::get('/checkouts/{id}', [CheckoutController::class, 'show']);
Route::put('/checkouts/{id}', [CheckoutController::class, 'update']);
Route::delete('/checkouts/{id}', [CheckoutController::class, 'destroy']);

Route::get('/expenses', [ExpenseController::class, 'index']);
Route::post('/expenses', [ExpenseController::class, 'store']);
Route::get('/expenses/{id}', [ExpenseController::class, 'show']);
Route::put('/expenses/{id}', [ExpenseController::class, 'update']);
Route::delete('/expenses/{id}', [ExpenseController::class, 'destroy']);




