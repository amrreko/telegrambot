<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;
class TelegramController extends Controller
{
    public function updateActivity(){
        $activity = Telegram::getUpdates();
        dd($activity);
    }
}
