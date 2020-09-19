<?php

declare(strict_types = 1);

namespace Folded;

if (!function_exists("addLog")) {
    /**
     * Logs an message of the desired severity.
     *
     * @param string $loggerName The name of the logger to use.
     * @param string $severity   The severity to use ("alert", "critical", "debug", "emergency", "error", "info", "notice", "warning").
     * @param string $message    The message to log.
     *
     * @throws InvalidArgumentException If the logger has not be registered yet.
     * @throws InvalidArgumentException If the severity is not supported.
     *
     * @since 0.1.0
     *
     * @example
     * addInfoLog("myLogger", "Some message");
     */
    function addLog(string $loggerName, string $severity, string $message, array $parameters = []): void
    {
        Logger::addLog($loggerName, $severity, $message, $parameters);
    }
}
