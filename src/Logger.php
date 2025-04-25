<?php
namespace SwebApi;

/**
 * Отвечает за запись логов в logs/api.log.
 */
class Logger
{
    /**
     * Записывает сообщение в лог-файл с отметкой времени.
     *
     * @param string $message Сообщение для записи в лог
     * @return void
     */
    public static function log(string $message): void
    {
        $line = "[" . date('Y-m-d H:i:s') . "] " . $message . PHP_EOL;
        file_put_contents(__DIR__ . '/../logs/api.log', $line, FILE_APPEND);
    }
}