# folded/log

Log information to various channels for your web app.

[![Packagist License](https://img.shields.io/packagist/l/folded/log)](https://github.com/folded-php/log/blob/master/LICENSE) [![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/folded/log)](https://github.com/folded-php/log/blob/master/composer.json#L14) [![Packagist Version](https://img.shields.io/packagist/v/folded/log)](https://packagist.org/packages/folded/log) [![Build Status](https://travis-ci.com/folded-php/log.svg?branch=master)](https://travis-ci.com/folded-php/log) [![Maintainability](https://api.codeclimate.com/v1/badges/e24be0ab29a9b4119765/maintainability)](https://codeclimate.com/github/folded-php/log/maintainability) [![TODOs](https://img.shields.io/endpoint?url=https://api.tickgit.com/badge?repo=github.com/folded-php/log)](https://www.tickgit.com/browse?repo=github.com/folded-php/log)

## Summary

- [About](#about)
- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Examples](#examples)
- [Version support](#version-support)

## About

I created this package to simply setup Monolog, usable in any projects easily.

Folded is a constellation of packages to help you setting up a web app easily, using ready to plug in packages.

- [folded/action](https://github.com/folded-php/action): A way to organize your controllers for your web app.
- [folded/config](https://github.com/folded-php/config): Configuration utilities for your PHP web app.
- [folded/crypt](https://github.com/folded-php/crypt): Encrypt and decrypt strings for your web app.
- [folded/exception](https://github.com/folded-php/exception): Various kind of exception to throw for your web app.
- [folded/history](https://github.com/folded-php/history): Manipulate the browser history for your web app.
- [folded/http](https://github.com/folded-php/http): HTTP utilities for your web app.
- [folded/orm](https://github.com/folded-php/orm): An ORM for you web app.
- [folded/session](https://github.com/folded-php/session): Session functions for your web app.
- [folded/request](https://github.com/folded-php/request): Request utilities, including a request validator, for your PHP web app.
- [folded/routing](https://github.com/folded-php/routing): Routing functions for your PHP web app.
- [folded/view](https://github.com/folded-php/view): View utilities for your PHP web app.

## Features

- Uses [monolog/monolog](https://github.com/Seldaek/monolog)
- Can add multiple "write channels" (example: file, ...) to the same logger
- Supports the following channels:
  - File (e.g. StreamHandler)

## Requirements

- PHP version >= 7.4.0
- Composer installed

## Installation

- [1. Install the package](#1-install-the-package)
- [2. Add the setup code](#2-add-the-setup-code)

### 1. Install the package

In your root folder, run this command:

```bash
composer require folded/log
```

## Examples

- [1. Log a debug message to a file](#1-log-a-debug-message-to-a-file)
- [2. Add extra parameters when logging](#2-add-extra-parameters-when-logging)
- [3. Log by choosing your severity manually](#3-log-by-choosing-your-severity-manually)
- [4. Add another channel to the same logger](#4-add-another-channel-to-the-same-logger)

### 1. Create a file logger

In this example, we will create a file logger, and then we will log a debug information into our log file.

```php
use function Folded\addLogger;
use function Folded\addDebugLog;

addLogger("myLogger", "file", [
  "path" => __DIR__ . "/logs/my-file.log",
]);

addDebugLog("myLogger", "This is my first debug log!");
```

Note that if you want to avoid typos, you can use constants for defining the file channel.

```php
use function Folded\addLogger;
use function Folded\addDebugLog;
use const Folded\CHANNEL_FILE;

addLogger("myLogger", CHANNEL_FILE, [
  "path" => __DIR__ . "/logs/my-file.log",
]);

addDebugLog("myLogger", "This is my first debug log!");
```

For the moment, there is only one channel:

```php
use const Folded\CHANNEL_FILE;
```

You can log various severities. Here is all the log methods available:

- addAlertLog
- addCriticalLog
- addDebugLog
- addEmergencyLog
- addErrorLog
- addInfoLog
- addNoticeLog
- addWarningLog

### 2. Add extra parameters when logging

In this example, we will push extra data as key-value pairs alongisde our log message.

```php
use function Folded\addLogger;
use function Folded\addDebugLog;

addLogger("myLogger", "file", [
  "path" => __DIR__ . "/logs/my-file.log",
]);

addDebugLog("myLogger", "a user has registered", [
  "timestamp" => 1577836800,
]);
```

### 3. Log by choosing your severity manually

In this example, we will use a `addLog` function, which let us choose the severity using a string for more flexibility.

```php
use function Folded\addLogger;
use function Folded\addLog;

addLogger("myLogger", "file", [
  "path" => __DIR__ . "/logs/neutral.log",
]);

addLog("myLogger", "warning", "User email invalid");
```

Note you can use severity constants provided by this library if you want to avoid typos:

```php
use function Folded\addLogger;
use function Folded\addLog;
use const Folded\SEVERITY_WARNING;

addLogger("myLogger", "file", [
  "path" => __DIR__ . "/logs/neutral.log",
]);

addLog("myLogger", SEVERITY_WARNING, "User email invalid");
```

Here is a complete list of severities you can use:

```php
use const Folded\SEVERITY_ALERT;
use const Folded\SEVERITY_CRITICAL;
use const Folded\SEVERITY_DEBUG;
use const Folded\SEVERITY_EMERGENCY;
use const Folded\SEVERITY_ERROR;
use const Folded\SEVERITY_INFO;
use const Folded\SEVERITY_NOTICE;
use const Folded\SEVERITY_WARNING;
```

### 4. Add another channel to the same logger

In this example, our logger will log to 2 differents files.

```php
use function Folded\addLogger;
use function Folded\addLoggerChannel;

addLogger("myLogger");

// First file
addLoggerChannel("myLogger", "file", [
  "path" => "path/to/file-1.log",
]);

// Second file
addLoggerChannel("myLogger", "file", [
  "path" => "path/to/file-2.log",
]);
```

Now, everytime you call a log method like `addDebugLog()`, the log will be written in these two files.

This is very powerful when this library will be able to provide with different kind of channels, so you will be able to write both in a file and in your Syslog channel for example.

## Version support

|        | 7.3 | 7.4 | 8.0 |
| ------ | --- | --- | --- |
| v0.1.0 | ❌  | ✔️  | ❓  |
| v0.1.1 | ❌  | ✔️  | ❓  |
