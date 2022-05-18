<?php
namespace App\Telegram\Commands;

use Illuminate\Support\Facades\Log;
use Telegram\Bot\Commands\Command;
use Telegram;

/**
 * Class ResultCommand.
 */
class ResultCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = 'result';

    /**
     * @var array Command Aliases
     */
    protected $aliases = ['resultcommands'];

    /**
     * @var string Command Description
     */
    protected $description = 'Result command, Get a result';
    protected $pattern = '{result}';

    /**
     * {@inheritdoc}
     */
    public function handle()
    
    {
        $response = $this->getUpdate();
        $text = 'نتيجتك :'.chr(10).chr(10);
        if($this->getArguments())
        {
            $args = $this->getArguments();
         
            Log::debug($args);
            if(isset($args) && is_array($args) ){
               
                if(isset($args['result'])){
                    $text .= $args['result'].chr(10).chr(10);
                    Log::debug($args['result']);
                }
                
             } 
        }
       
       
    
        $this->replyWithMessage(compact('text'));

    }
}