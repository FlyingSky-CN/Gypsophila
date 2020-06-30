<?php
/**
 * Gypsophila
 * 
 * @author FlyingSky-CN
 */

use Longman\TelegramBot\Telegram;
use Longman\TelegramBot\Exception\TelegramException;

class Gypsophila
{
    /**
     * Set Webhook
     * 
     * @package Main
     * @param string $bot_api_key
     * @param string $bot_username
     * @param string $hook_url
     * @return string
     */
    public static function setWebhook(String $bot_api_key, String $bot_username, String $hook_url)
    {
        try {
            // Create Telegram API object
            $telegram = new Telegram($bot_api_key, $bot_username);
        
            // Set webhook
            $result = $telegram->setWebhook($hook_url);

            return $result->isOk() ? $result->getDescription() : "Unknow error.";

        } catch (TelegramException $e) {
            // log telegram errors
            return $e->getMessage();

        }
    }

    /**
     * Unet Webhook
     * 
     * @package Main
     * @param string $bot_api_key
     * @param string $bot_username
     * @return string
     */
    public static function unsetWebhook(String $bot_api_key, String $bot_username)
    {
        try {
            // Create Telegram API object
            $telegram = new Telegram($bot_api_key, $bot_username);

            // Delete webhook
            $result = $telegram->deleteWebhook();

            return $result->isOk() ? $result->getDescription() : "Unknow error.";

        } catch (TelegramException $e) {

            return $e->getMessage();

        }
    }

    /**
     * Handle Webhook
     * 
     * @package Main
     * @param string $bot_api_key
     * @param string $bot_username
     * @return string|void
     */
    public static function handleWebhook(String $bot_api_key, String $bot_username)
    {
        try {
            // Create Telegram API object
            $telegram = new Telegram($bot_api_key, $bot_username);

            // Define all paths for your custom commands in this array (leave as empty array if not used)
            // Add this line inside the try{}
            $telegram->addCommandsPaths([__DIR__.'/Commands']);

            // Handle telegram webhook request
            $telegram->enableLimiter();
            $telegram->handle();

        } catch (TelegramException $e) {
            // Silence is golden!
            // log telegram errors
            return $e->getMessage();
        }
    }
}