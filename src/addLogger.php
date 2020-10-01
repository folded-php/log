<?php

declare(strict_types = 1);

namespace Folded;

if (!function_exists("Folded\addLogger")) {
    /**
     * Registers a new logger.
     * If the last two parameters are specified, will also triggers an addLoggerChannel method.
     *
     * @param string $name       The name to uniquely identify the logger.
     * @param string $channel    The name of the channel type (default: null).
     * @param array  $parameters The parameters for the channel (default: null).
     *
     * @throws InvalidArgumentException If the logger has not be registered yet.
     * @throws InvalidArgumentException If the channel is not supported.
     *
     * @since 0.1.0
     *
     * @example
     * addLogger("myLogger", "file", [
     * 	"path" => "path/to/file.log",
     * ]);
     */
    function addLogger(string $name, ?string $channel = null, ?array $parameters = null): void
    {
        Logger::add($name, $channel, $parameters);
    }
}
