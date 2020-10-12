<?php

declare(strict_types = 1);

namespace Folded;

use InvalidArgumentException;

if (!function_exists("Folded\addAlertLog")) {
    /**
     * Logs an alert.
     *
     * @param string       $loggerName The name of the logger to use.
     * @param string       $message    The message to log.
     * @param array<mixed> $context    The parameters to add (default: []).
     *
     * @throws InvalidArgumentException If the logger has not be registered yet.
     *
     * @since 0.1.0
     *
     * @example
     * addAlertLog("myLogger", "Some message");
     */
    function addAlertLog(string $loggerName, string $message, array $context = []): void
    {
        Logger::addAlertLog($loggerName, $message, $context);
    }
}
