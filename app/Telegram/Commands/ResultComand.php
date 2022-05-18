<?php
namespace App\Telegram\Commands;

use Illuminate\Support\Facades\Log;
use Telegram\Bot\Commands\Command;
use Telegram;

/**
 * Class HelloCommand.
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
    protected $aliases = ['result:'];

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
                Log::debug($args); 
                if(isset($args['result'])){
                    $text .= $args['result'];
                }
                
             } 
        }
       
       
    
        $this->replyWithMessage(compact('text'));

    }
}