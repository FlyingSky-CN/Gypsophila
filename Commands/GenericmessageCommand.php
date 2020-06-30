<?php
/**
 * Gypsophila
 * 
 * @author FlyingSky-CN
 */

namespace Longman\TelegramBot\Commands\SystemCommands;

use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;

/**
 * Generic message command
 */
class GenericmessageCommand extends SystemCommand
{
    protected $name = 'genericmessage';
    protected $description = 'Handle generic message';
    protected $version = '1.0.0';

    public function execute(): ServerResponse
    {
        // Handle new chat members.
        if ($this->getMessage()->getNewChatMembers()) {
            return $this->getTelegram()->executeCommand('newchatmembers');
        }

        return parent::execute();
    }
}