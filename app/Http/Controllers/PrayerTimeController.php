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
    public function test()
    {
        $text = 'أهلا بيك'.'<br>';
        $text .= 'ربنا يحفظ ادعى لى محتاج حاجة ممكن تدخل على الموقع التالي'.'<br>';
        $text .= env('APP_URL').'<br>';
        $text .= 'اضغط  /1  للتحديث'.'<br>';
        $text .= '-------'.'<br>';
        $date =  Carbon::now('Africa/Cairo')->locale('ar');
        $day = $date->isoFormat('LLLL');
        $clock = $date->format('g:i A');
        $text .= 'اليوم :'.$day.'<br>';
        $text .= 'الساعة :'.$clock.'<br>';

        $prayTime = new PrayTime();
        $prayTime->setCalcMethod($prayTime->Egypt);
        $times = $prayTime->getPrayerTimes(Carbon::today('Africa/Cairo')->getTimestamp(), 30.033333,    31.233334, +2);
        // $now = Carbon::now('Africa/Cairo');
        
        // $diff = array();
        
        for($i=0;$i<=5;$i++){
            $azan = str_replace(['PM','AM'],['مساءً','صباحًا'],Carbon::parse($times[$i])->locale('ar')->format('g:i A'));
            $text .= $this->getPrayerName($i) .' توقيت '. $azan.'<br>';
        //    $diff[$i] = $now->diffInMinutes(Carbon::parse($times[$i]));
        }
        // $index = array_keys($diff, min($diff));
        // $text .=' باقي الآن '.$index.' على آذان '.  $times[$index].'<br>';

        return $text;
    }
}
