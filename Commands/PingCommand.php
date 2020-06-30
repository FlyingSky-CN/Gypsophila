<?php
/**
 * Gypsophila
 * 
 * @author FlyingSky-CN
 */

namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Request;

class PingCommand extends UserCommand
{
    protected $name = 'ping';
    protected $description = 'A command for test';
    protected $usage = '/ping';
    protected $version = '1.0.0';

    public function execute()
    {
        $message = $this->getMessage();

        return Request::sendMessage([
            'chat_id' => $message->getChat()->getId(),
            'text'    => 'Pong!'
        ]);
    }
}