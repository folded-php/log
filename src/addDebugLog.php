<?php

declare(strict_types = 1);

namespace Folded;

if (!function_exists("Folded\addDebugLog")) {
    /**
     * Logs a debug message.
     *
     * @param string $loggerName The name of the logger to use.
     * @param string $message    The message to log.
     * @param array  $context    The parameters to add (default: []).
     *
     * @throws InvalidArgumentException If the logger has not be registered yet.
     *
     * @since 0.1.0
     *
     * @example
     * addDebugLog("myLogger", "Some message");
     */
    function addDebugLog(string $loggerName, string $message, array $context = []): void
    {
        Logger::addDebugLog($loggerName, $message, $context);
    }
}
