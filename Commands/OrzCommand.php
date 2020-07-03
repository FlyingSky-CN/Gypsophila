<?php
/**
 * Gypsophila
 * 
 * @author FlyingSky-CN
 */

namespace Longman\TelegramBot\Commands\UserCommands;

use Lin_Db;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\TelegramLog;
use Longman\TelegramBot\Request;

/**
 * User "/orz" command
 */
class OrzCommand extends UserCommand
{
    protected $name = 'orz';
    protected $description = 'Orz';
    protected $usage = '/orz';
    protected $version = '1.0.0';
    protected $group_only = true;

    public function execute()
    {
        $message          = $this->getMessage();
        $reply_to_message = $message->getReplyToMessage();

        if ($reply_to_message && $message->getChat()->isGroupChat()) {
            $orzFrom = $message->getFrom();
            $orzTo   = $reply_to_message->getFrom();

            if ($orzFrom->getId() === $orzTo->getId()) {
                $text = 'Orz?';
            } else {
                $orzFromName = htmlspecialchars(($orzFrom->getFirstName() && $orzFrom->getLastName()) ?
                    $orzFrom->getFirstName().' '.$orzFrom->getLastName() :
                    $orzFrom->getFirstName().$orzFrom->getLastName());
                $orzFromId   = $orzFrom->getId();
                $orzToName   = htmlspecialchars(($orzTo->getFirstName() && $orzTo->getLastName()) ?
                    $orzTo->getFirstName().' '.$orzTo->getLastName() :
                    $orzTo->getFirstName().$orzTo->getLastName());
                $orzToId     = $orzTo->getId();

                $text = "<a href='tg://user?id=$orzFromId'>$orzFromName</a> 膜了 <a href='tg://user?id=$orzToId'>$orzToName</a>";

            }

        } else $text = 'Orz?';

        Request::deleteMessage([
            'chat_id' => $message->getChat()->getId(),
            'message_id' => $message->getMessageId()
        ]);

        return Request::sendMessage([
            'chat_id'    => $message->getChat()->getId(),
            'text'       => $text,
            'parse_mode' => 'HTML'
        ]);
    }
}
