<?php
/**
 * Gypsophila
 * 
 * @author FlyingSky-CN
 */

namespace Longman\TelegramBot\Commands\SystemCommands;

use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Request;

/**
 * Start command
 *
 * Gets executed when a user first starts using the bot.
 */
class StartCommand extends SystemCommand
{
    protected $name         = 'start';
    protected $description  = 'Start command';
    protected $usage        = '/start';
    protected $version      = '1.0.0';
    protected $private_only = true;

    public function execute()
    {
        $message = $this->getMessage();

        return Request::sendMessage([
            'chat_id' => $message->getChat()->getId(),
            'text'    => 'Hi there!'.PHP_EOL.'Type /help to see all commands!'
        ]);
    }
}
