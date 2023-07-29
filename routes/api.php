<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\FlareClient\Api;
use App\Http\Controllers\ApiController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/show',[ApiController::class,'show']);
Route::get('/showbyid/{empId}',[ApiController::class,'showbyid']);
Route::get('/showbyname/{firstName}',[ApiController::class,'showbyname']);
Route::post('/add',[ApiController::class,'store']);
Route::put('/updatebyname/{firstName}',[ApiController::class,'updatebyname']);
Route::delete('/deletebyname/{firstName}',[ApiController::class,'deletebyname']);
Route::post('/save',[ApiController::class,'save']);