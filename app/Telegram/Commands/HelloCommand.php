<?php
namespace App\Telegram\Commands;

use Illuminate\Support\Facades\Log;
use Telegram\Bot\Commands\Command;
use Telegram;

/**
 * Class HelloCommand.
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
    protected $aliases = ['hellocommands'];

    /**
     * @var string Command Description
     */
    protected $description = 'Hello command, Get a message of hello commands';

    /**
     * {@inheritdoc}
     */
    public function handle()
    
    {
        $response = $this->getUpdate();
        $text = 'أهلا بيك مرحبًا'.chr(10).chr(10);
    
        $this->replyWithMessage(compact('text'));

    }
}