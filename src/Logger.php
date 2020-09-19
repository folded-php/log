<?php

declare(strict_types = 1);

namespace Folded;

use InvalidArgumentException;
use Monolog\Handler\StreamHandler;
use Monolog\Logger as MonologLogger;

/**
 * Represents the logger that push messages and data to a channel (file, syslog, ...).
 *
 * @since 0.1.0
 */
class Logger
{
    /**
     * The current logger that is being processed.
     *
     * @since 0.1.0
     */
    private static ?MonologLogger $currentLogger = null;

    /**
     * Stores all the registered loggers (each logger is an instance of MonologLogger).
     *
     * @since 0.1.0
     */
    private static array $loggers = [];

    /**
     * Registers a new logger.
     * If the last two parameters are specified, will also triggers an addChannel method.
     *
     * @param string $name       The name to uniquely identify the logger.
     * @param array  $parameters The parameters for the channel (default: null).
     *
     * @throws InvalidArgumentException If the logger has not be registered yet.
     * @throws InvalidArgumentException If the channel is not supported.
     *
     * @since 0.1.0
     *
     * @example
     * Logger::add("myLogger", "file", [
     * 	"path" => "path/to/file.log",
     * ]);
     */
    public static function add(string $name, ?string $channel = null, ?array $parameters = null): void
    {
        self::$loggers[$name] = new MonologLogger($name);

        if (is_string($channel) && is_array($parameters)) {
            self::addChannel($name, $channel, $parameters);
        }
    }

    /**
     * Logs an alert.
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
     * Logger::addAlertLog("myLogger", "Some message");
     */
    public static function addAlertLog(string $loggerName, string $message, array $context = []): void
    {
        self::getLogger($loggerName)->alert($message, $context);
    }

    /**
     * Add a channel to write by the logger.
     *
     * @param string $loggerName The name of the logger to add the channel on.
     * @param string $channel    The type of channel (allowed: "file").
     * @param array  $parameters The parameters for the channel.
     *
     * @throws InvalidArgumentException If the logger has not be registered yet.
     * @throws InvalidArgumentException If the channel is not supported.
     *
     * @since 0.1.0
     *
     * @example
     * Logger::addChannel("myLogger", "file", [
     * 	"path" => "path/to/file.log",
     * ]);
     */
    public static function addChannel(string $loggerName, string $channel, array $parameters): void
    {
        if (!in_array($channel, SUPPORTED_CHANNELS, true)) {
            throw new InvalidArgumentException("channel $channel not supported (supported: " . implode(", ", SUPPORTED_CHANNELS));
        }

        self::$currentLogger = self::getLogger($loggerName);

        if ($channel === CHANNEL_FILE) {
            self::addFileChannel($parameters);
        }
    }

    /**
     * Logs a critical message.
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
     * Logger::addCriticalLog("myLogger", "Some message");
     */
    public static function addCriticalLog(string $loggerName, string $message, array $context = []): void
    {
        self::getLogger($loggerName)->critical($message, $context);
    }

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
     * Logger::addDebugLog("myLogger", "Some message");
     */
    public static function addDebugLog(string $loggerName, string $message, array $context = []): void
    {
        self::getLogger($loggerName)->debug($message, $context);
    }

    /**
     * Logs an emergency message.
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
     * Logger::addEmergencyLog("myLogger", "Some message");
     */
    public static function addEmergencyLog(string $loggerName, string $message, array $context = []): void
    {
        self::getLogger($loggerName)->emergency($message, $context);
    }

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
     * Logger::addErrorLog("myLogger", "Some message");
     */
    public static function addErrorLog(string $loggerName, string $message, array $context = []): void
    {
        self::getLogger($loggerName)->error($message, $context);
    }

    /**
     * Logs an info message.
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
     * Logger::addInfoLog("myLogger", "Some message");
     */
    public static function addInfoLog(string $loggerName, string $message, array $context = []): void
    {
        self::getLogger($loggerName)->info($message, $context);
    }

    /**
     * Logs an message of the desired severity.
     *
     * @param string $loggerName The name of the logger to use.
     * @param string $severity   The severity to use ("alert", "critical", "debug", "emergency", "error", "info", "notice", "warning").
     * @param string $message    The message to log.
     * @param array  $context    The parameters to add (default: []).
     *
     * @throws InvalidArgumentException If the logger has not be registered yet.
     * @throws InvalidArgumentException If the severity is not supported.
     *
     * @since 0.1.0
     *
     * @example
     * Logger::addInfoLog("myLogger", "Some message");
     */
    public static function addLog(string $loggerName, string $severity, string $message, array $context = []): void
    {
        if (!in_array($severity, SUPPORTED_SEVERITIES, true)) {
            throw new InvalidArgumentException("severity $severity not supported");
        }

        self::getLogger($loggerName)->log(MONOLOG_SEVERITIES[$severity], $message, $context);
    }

    /**
     * Logs a notice.
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
     * Logger::addNoticeLog("myLogger", "Some message");
     */
    public static function addNoticeLog(string $loggerName, string $message, array $context = []): void
    {
        self::getLogger($loggerName)->notice($message, $context);
    }

    /**
     * Logs a warning.
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
     * Logger::addWarningLog("myLogger", "Some message");
     */
    public static function addWarningLog(string $loggerName, string $message, array $context = []): void
    {
        self::getLogger($loggerName)->warning($message, $context);
    }

    /**
     * Reset the state of the class.
     * Useful for unit testing.
     *
     * @since 0.1.0
     *
     * @example
     * Logger::clear();
     */
    public static function clear(): void
    {
        self::$currentLogger = null;
        self::$loggers = [];
    }

    /**
     * Adds a file channel to the current logger.
     *
     * @param array $parameters The parameters for the file channel.
     *
     * @since 0.1.0
     *
     * @example
     * Logger::addFileChannel([
     * 	"path" => "path/to/file.log",
     * ]);
     */
    private static function addFileChannel(array $parameters): void
    {
        $path = $parameters["path"];

        self::$currentLogger->pushHandler(new StreamHandler($path));
    }

    /**
     * Get a logger by its name.
     *
     * @param string $loggerName The name of the logger.
     *
     * @throws InvalidArgumentException If the logger has not be registered yet.
     *
     * @since 0.1.0
     *
     * @example
     * Logger::getLogger("myLogger");
     */
    private static function getLogger(string $loggerName): MonologLogger
    {
        if (!isset(self::$loggers[$loggerName])) {
            throw new InvalidArgumentException("logger $loggerName not found");
        }

        return self::$loggers[$loggerName];
    }
}
