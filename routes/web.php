<?php
use Illuminate\Support\Facades\Route;
use Telegram\Bot\Laravel\Facades\Telegram;

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
Route::post('/42yUojv1YQPOssPEpn5i3q6vjdhh7hl7djVWDIAVhFDRMAwZ1tj0Og2v4PWyj4PZ/webhook', function () {
    $update = Telegram::commandsHandler(true);
});


Route::get('/prayer-time',[App\Http\Controllers\PrayerTimeController::class,'getPrayerTime']);