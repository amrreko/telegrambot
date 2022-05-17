<?php

namespace App\Telegram\Commands;
use Telegram\Bot\Commands\Command;
use Telegram;

/**
 * Class HelpCommand.
 */
class HelloCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = 'hello';

    /**
     * @var array Command Aliases
     */
    protected $aliases = ['listcommands'];

    /**
     * @var string Command Description
     */
    protected $description = 'Hello command, Get a list of all commands';

    /**
     * {@inheritdoc}
     */
    public function handle()
    
    {
        $response = $this->getUpdate();
        
        $text = 'أهلا بيك'.chr(10).chr(10);
       
    
        $this->replyWithMessage(compact('text'));

    }
}