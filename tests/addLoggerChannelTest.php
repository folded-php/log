<?php

declare(strict_types = 1);

use Folded\Logger;
use function Folded\addDebugLog;
use function Folded\addLogger;
use function Folded\addLoggerChannel;
use const Folded\CHANNEL_FILE;

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

it("should add the file logger", function (): void {
    $log = "some debug";
    $path = __DIR__ . "/misc/logs/file.log";

    addLogger("file");

    addLoggerChannel("file", CHANNEL_FILE, [
        "path" => $path,
    ]);

    addDebugLog("file", $log);

    expect(getFileContent($path))->toContain("file.DEBUG: $log");
});
