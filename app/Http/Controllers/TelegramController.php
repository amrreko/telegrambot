<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\FileUpload\InputFile;
use Telegram\Bot\Laravel\Facades\Telegram;
use Illuminate\Support\Str;
class TelegramController extends Controller
{
    protected $chat_id;
    public function __construct()
    {
        $this->chat_id = '-1001410028229';

    }
    public function updateActivity(){
        $activity = Telegram::getUpdates();
        dd($activity);
    }
    public function sendMessage()
     {
         return view('telegram-view');
     }

     public function storeMessage(Request $request)
     {
         $request->validate([
             'name' => 'required',
             'message' => 'required'
         ]);

         $text =  "<b>Name: </b>\n"
             . "$request->name\n"
             . "<b>Message: </b>\n"
             . $request->message;

         Telegram::sendMessage([
             'chat_id' => $this->chat_id,
             'parse_mode' => 'HTML',
             'text' => $text
         ]);

         return redirect()->back();
     }

     public function storePhoto(Request $request)
     {
         $request->validate([
             'file' => 'file|mimes:jpeg,png,gif'
         ]);

         $photo = $request->file('file');

         Telegram::sendPhoto([
             'chat_id' => $this->chat_id,
             'photo' => InputFile::createFromContents(file_get_contents($photo->getRealPath()), Str::random(10) . '.' . $photo->getClientOriginalExtension()),
             'caption' => 'Photo Image'
         ]);

         return redirect()->back();
     }

}
