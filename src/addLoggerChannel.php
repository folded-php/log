<?php

declare(strict_types = 1);

namespace Folded;

use InvalidArgumentException;

if (!function_exists("Folded\addLoggerChannel")) {
    /**
     * Add a channel to write by the logger.
     *
     * @param string       $loggerName The name of the logger to add the channel on.
     * @param string       $channel    The type of channel (allowed: "file").
     * @param array<mixed> $parameters The parameters for the channel.
     *
     * @throws InvalidArgumentException If the logger has not be registered yet.
     * @throws InvalidArgumentException If the channel is not supported.
     *
     * @since 0.1.0
     *
     * @example
     * addLoggerChannel("myLogger", "file", [
     * 	"path" => "path/to/file.log",
     * ]);
     */
    function addLoggerChannel(string $loggerName, string $channel, array $parameters): void
    {
        Logger::addChannel($loggerName, $channel, $parameters);
    }
}
