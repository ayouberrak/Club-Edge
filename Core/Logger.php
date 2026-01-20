<?php

namespace Core ; 

class Logger
{
    private static string $logFile = __DIR__ .  '/../logs/app.log';

    public static function error(string $message): void
    {
        $date = date('Y-m-d H:i:s');
        $log  = "[{$date}] ERROR: {$message}" . PHP_EOL;

        file_put_contents(self::$logFile, $log, FILE_APPEND);
    }
}