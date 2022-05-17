<?php

namespace App\Telegram\Commands;

use App\Services\PrayTime;
use Illuminate\Support\Carbon;
use Telegram\Bot\Commands\Command;
use Telegram;

/**
 * Class HelpCommand.
 */
class HelpCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = 'help';

    /**
     * @var array Command Aliases
     */
    protected $aliases = ['listcommands'];

    /**
     * @var string Command Description
     */
    protected $description = 'Help command, Get a list of all commands';

    /**
     * {@inheritdoc}
     */
    public function handle()
    
    {
        $response = $this->getUpdate();
        
        $text = 'أهلا بيك'.chr(10).chr(10);
        $text .= 'ربنا يحفظ عمرو ادعى لي'.chr(10);
        $text .= env('APP_URL').chr(10).chr(10);
        $text .= 'اضغط  /update  للتحديث'.chr(10);
        $text .= '-------'.chr(10);
        $date =  Carbon::now('Africa/Cairo')->locale('ar');
        $day = $date->isoFormat('LLL');
        $clock = $date->format('g:i A');
        $text .= 'اليوم :'.$day.chr(10);
        $text .= 'الساعة :'.$clock.chr(10);

        $prayTime = new PrayTime();
        $prayTime->setCalcMethod($prayTime->Egypt);
        $times = $prayTime->getPrayerTimes(Carbon::today('Africa/Cairo')->getTimestamp(), 30.033333,    31.233334, +2);
      
        for($i=0;$i<=5;$i++){
            // $text .= $this->getPrayerName($i) .' توقيت '.  $times[$i].chr(10);
            if(!in_array($i,[1,4])){
            $azan = str_replace(['PM','AM'],['مساءً','صباحًا'],Carbon::parse($times[$i])->locale('ar')->format('g:i A'));
            $text .= $this->getPrayerName($i) .' توقيت '. $azan.chr(10);
            }
        }
    
        $this->replyWithMessage(compact('text'));

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