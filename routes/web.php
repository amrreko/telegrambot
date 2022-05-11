<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[App\Http\Controllers\TelegramController::class,'sendMessage']);
Route::get('/updated-activity',[App\Http\Controllers\TelegramController::class,'updateActivity']);
Route::post('/send-message',[App\Http\Controllers\TelegramController::class,'storeMessage']);
Route::post('/store-photo',[App\Http\Controllers\TelegramController::class,'storePhoto']);

