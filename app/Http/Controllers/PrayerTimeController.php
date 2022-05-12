<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PrayTime;
use Illuminate\Support\Carbon;

class PrayerTimeController extends Controller
{
    public $times;
    public $prayers;
    public function getPrayerTime(PrayTime $prayTime)
    {
        $prayTime->setCalcMethod($prayTime->Egypt);
        $times = $prayTime->getPrayerTimes(Carbon::today('Africa/Cairo')->getTimestamp(), 30.033333,    31.233334, +2);
        for($i=0;$i<=5;$i++){
           $prayers[$this->getPrayerName($i)]=  $times[$i];
        }
        $this->times = $times;
        $this->prayers = $prayers;

         return response()->json($prayers, 200, [], JSON_UNESCAPED_UNICODE);
        
    }

    public function getPrayerName($index)
    {
        switch ($index) {
            case '0':
                return 'آذان الفجر';
                break;
            case '1':
                return 'توقيت الشروق';
                break;
            case '2':
                return 'آذان الظهر';
                break;
            case '3':
                return 'آذان العصر';
                break;
            case '4':
                return 'آذان المغرب';
                break;
            case '5':
                return 'آذان العشاء';
                break;
            default:
            return '';
        }
    }
}
