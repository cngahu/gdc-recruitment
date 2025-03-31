<?php

namespace App\Helper;
use Illuminate\Support\Facades\Log;
class LogHelper
{
    public static function logError($message, $exception = null)
    {
        Log::error($message, [
            'exception' => $exception
        ]);
    }
    public static function logInfo($message, $context = [])
    {
        Log::info($message, $context);
    }
}
