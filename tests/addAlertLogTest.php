<?php

declare(strict_types = 1);

use Folded\Logger;
use function Folded\addAlertLog;
use function Folded\addLogger;
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

it("should add an alert in the file log", function (): void {
    $log = "my alert log";
    $path = __DIR__ . "/misc/logs/alert.log";

    addLogger("file", CHANNEL_FILE, [
        "path" => $path,
    ]);
    addAlertLog("file", $log);

    expect(getFileContent($path))->toContain("file.ALERT: $log");
});
