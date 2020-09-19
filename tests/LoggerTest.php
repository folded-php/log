<?php

declare(strict_types = 1);

use Folded\Logger;
use const Folded\CHANNEL_FILE;
use const Folded\SEVERITY_DEBUG;

if (!function_exists("getFileContent")) {
    function getFileContent(string $path): string
    {
        $file = fopen($path, "r");
        $content = fread($file, filesize($path));
        fclose($file);

        return $content;
    }
}

afterEach(function (): void {
    Logger::clear();

    $files = glob(__DIR__ . "/misc/logs/*.log");

    if ($files !== false) {
        foreach ($files as $file) {
            unlink($file);
        }
    }
});

it("should log alert in the file log", function (): void {
    $log = "something's wrong";
    $path = __DIR__ . "/misc/logs/alert.log";

    Logger::add("file", CHANNEL_FILE, [
        "path" => $path,
    ]);

    Logger::addAlertLog("file", $log);

    expect(getFileContent($path))->toContain("file.ALERT: $log");
});

it("should log critical in the file log", function (): void {
    $log = "such bug, very blocking";
    $path = __DIR__ . "/misc/logs/critical.log";

    Logger::add("file", CHANNEL_FILE, [
        "path" => $path,
    ]);
    Logger::addCriticalLog("file", $log);

    expect(getFileContent($path))->toContain("file.CRITICAL: $log");
});

it("should log emergency in the file log", function (): void {
    $log = "some intruders detected!";
    $path = __DIR__ . "/misc/logs/emergency.log";

    Logger::add("file", CHANNEL_FILE, [
        "path" => $path,
    ]);
    Logger::addEmergencyLog("file", $log);

    expect(getFileContent($path))->toContain("file.EMERGENCY: $log");
});

it("should log error in the file log", function (): void {
    $log = "some file is missing";
    $path = __DIR__ . "/misc/logs/error.log";

    Logger::add("file", CHANNEL_FILE, [
        "path" => $path,
    ]);
    Logger::addErrorLog("file", $log);

    expect(getFileContent($path))->toContain("file.ERROR: $log");
});

it("should log info in the file log", function (): void {
    $log = "hello world";
    $path = __DIR__ . "/misc/logs/info.log";

    Logger::add("file", CHANNEL_FILE, [
        "path" => $path,
    ]);

    Logger::addInfoLog("file", $log);

    expect(getFileContent($path))->toContain("file.INFO: $log");
});

it("should log debug in the file log", function (): void {
    $log = "user is 42 yo";
    $path = __DIR__ . "/misc/logs/debug.log";

    Logger::add("file", CHANNEL_FILE, [
        "path" => $path,
    ]);
    Logger::addDebugLog("file", $log);

    expect(getFileContent($path))->toContain("file.DEBUG: $log");
});

it("should log notice in the file log", function (): void {
    $log = "the user wants his authentication to be remembered";
    $path = __DIR__ . "/misc/logs/notice.log";

    Logger::add("file", CHANNEL_FILE, [
        "path" => $path,
    ]);
    Logger::addNoticeLog("file", $log);

    expect(getFileContent($path))->toContain("file.NOTICE: $log");
});

it("should log in the file log", function (): void {
    $log = "this is a debug log";
    $path = __DIR__ . "/misc/logs/log.log";

    Logger::add("file", CHANNEL_FILE, [
        "path" => $path,
    ]);
    Logger::addLog("file", SEVERITY_DEBUG, $log);

    expect(getFileContent($path))->toContain("file.DEBUG: $log");
});

it("should log warning in the file log", function (): void {
    $log = "user entered a wrong email";
    $path = __DIR__ . "/misc/logs/warning.log";

    Logger::add("file", CHANNEL_FILE, [
        "path" => $path,
    ]);
    Logger::addWarningLog("file", $log);

    expect(getFileContent($path))->toContain("file.WARNING: $log");
});

it("should log extra data in the file log", function (): void {
    $extraData = ["timestamp" => 1577836800];
    $path = __DIR__ . "/misc/logs/extra-data.log";

    Logger::add("file", CHANNEL_FILE, [
        "path" => $path,
    ]);
    Logger::addDebugLog("file", "something something trident", $extraData);

    expect(getFileContent($path))->toContain(json_encode($extraData));
});

it("should throw exception if the channel is not supported", function (): void {
    $this->expectException(InvalidArgumentException::class);

    Logger::add("file", "foo", []);
});

it("should throw an exception message if the channel is not supported", function (): void {
    $this->expectExceptionMessage("channel foo not supported");

    Logger::add("file", "foo", []);
});

it("should throw an exception if the logger is not found", function (): void {
    $this->expectException(InvalidArgumentException::class);

    Logger::addChannel("foo", "file", []);
});

it("should throw an exception message if the logger is not found", function (): void {
    $this->expectExceptionMessage("logger foo not found");

    Logger::addChannel("foo", "file", []);
});

it("should throw an exception if the severity is not supported", function (): void {
    $this->expectException(InvalidArgumentException::class);

    Logger::add("file");
    Logger::addLog("file", "foo", "something interesting");
});

it("should throw an exception message if the severity is not supported", function (): void {
    $this->expectExceptionMessage("severity foo not supported");

    Logger::add("file");
    Logger::addLog("file", "foo", "something interesting");
});
