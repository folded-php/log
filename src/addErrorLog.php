<?php

declare(strict_types = 1);

namespace Folded;

if (!function_exists("addErrorLog")) {
    /**
     * Logs an error message.
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
     * addErrorLog("myLogger", "Some message");
     */
    function addErrorLog(string $loggerName, string $message, array $context = []): void
    {
        Logger::addErrorLog($loggerName, $message, $context);
    }
}
