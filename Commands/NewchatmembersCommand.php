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
 * New chat member command
 */
class NewchatmembersCommand extends SystemCommand
{
    protected $name = 'newchatmembers';
    protected $description = 'New Chat Members';
    protected $version = '1.0.0';

    public function execute()
    {
        $message = $this->getMessage();
        $members = $message->getNewChatMembers();
        $text    = 'Hi there!';

        if (!$message->botAddedInChat()) {
            $member_names = [];
            foreach ($members as $member) {
                $member_names[] = $member->tryMention();
            }
            $text = 'Hi ' . implode(', ', $member_names) . '!';
        }

        return Request::sendMessage([
            'chat_id' => $message->getChat()->getId(),
            'text'    => $text
        ]);
    }
}
