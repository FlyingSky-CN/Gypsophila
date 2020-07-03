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
                $orzFromName = ($orzFrom->getFirstName() && $orzFrom->getLastName()) ?
                    $orzFrom->getFirstName().' '.$orzFrom->getLastName() :
                    $orzFrom->getFirstName().$orzFrom->getLastName();
                $orzFromId   = $orzFrom->getId();
                $orzToName   = ($orzTo->getFirstName() && $orzTo->getLastName()) ?
                    $orzTo->getFirstName().' '.$orzTo->getLastName() :
                    $orzTo->getFirstName().$orzTo->getLastName();
                $orzToId     = $orzTo->getId();

                $text = "[$orzFromName](tg://user?id=$orzFromId) 膜了 [$orzToName](tg://user?id=$orzToId)";

            }

        } else $text = 'Orz?';

        return Request::sendMessage([
            'chat_id'    => $message->getChat()->getId(),
            'text'       => $text,
            'parse_mode' => 'MarkdownV2'
        ]);
    }
}
