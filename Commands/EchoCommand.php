<?php
/**
 * Gypsophila
 * 
 * @author FlyingSky-CN
 */

namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Request;

/**
 * User "/echo" command
 *
 * Simply echo the input back to the user.
 */
class EchoCommand extends UserCommand
{
    protected $name = 'echo';
    protected $description = 'Show text';
    protected $usage = '/echo <text>';
    protected $version = '1.0.0';

    public function execute()
    {
        $message = $this->getMessage();
        $text    = trim($message->getText(true));

        if ($text === '') $text = 'Command usage: ' . $this->getUsage();

        return Request::sendMessage([
            'chat_id' => $message->getChat()->getId(),
            'text'    => $text,
        ]);
    }
}
