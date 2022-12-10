<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;


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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('/',function(){
//     return response()->json([
//     'status' => 200,
//     'message' => 'hai'
//     ]);
// });
Route::get("list/{id?}", [ApiController::class, 'getdata']);      //get table data
Route::get("addcart/{id}", [ApiController::class, 'addcart']);    //add item to cart
Route::get("remcart/{id}", [ApiController::class, 'remcart']);    //remove item from cart
Route::get("delete/{id}", [ApiController::class, 'delete']);      //delete item from db
Route::post("add", [ApiController::class, 'adddata']);            //insert data to db