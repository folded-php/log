<?php

declare(strict_types = 1);

namespace Folded;

use Monolog\Logger;

/**
 * @since 0.1.0
 */
const SEVERITY_ALERT = "alert";

/**
 * @since 0.1.0
 */
const SEVERITY_CRITICAL = "critical";

/**
 * @since 0.1.0
 */
const SEVERITY_DEBUG = "debug";

/**
 * @since 0.1.0
 */
const SEVERITY_EMERGENCY = "emergency";

/**
 * @since 0.1.0
 */
const SEVERITY_ERROR = "error";

/**
 * @since 0.1.0
 */
const SEVERITY_INFO = "info";

/**
 * @since 0.1.0
 */
const SEVERITY_NOTICE = "notice";

/**
 * @since 0.1.0
 */
const SEVERITY_WARNING = "warning";

/**
 * @since 0.1.0
 */
const SUPPORTED_SEVERITIES = [
    SEVERITY_ALERT,
    SEVERITY_CRITICAL,
    SEVERITY_DEBUG,
    SEVERITY_EMERGENCY,
    SEVERITY_ERROR,
    SEVERITY_INFO,
    SEVERITY_INFO,
    SEVERITY_WARNING,
];

/**
 * @since 0.1.0
 */
const MONOLOG_SEVERITIES = [
    SEVERITY_ALERT => Logger::ALERT,
    SEVERITY_CRITICAL => Logger::CRITICAL,
    SEVERITY_DEBUG => Logger::DEBUG,
    SEVERITY_EMERGENCY => Logger::EMERGENCY,
    SEVERITY_ERROR => Logger::ERROR,
    SEVERITY_INFO => Logger::INFO,
    SEVERITY_NOTICE => Logger::NOTICE,
    SEVERITY_WARNING => Logger::WARNING,
];
