<?php

declare(strict_types = 1);

use Folded\Logger;
use const Folded\CHANNEL_FILE;
use function Folded\addLog;
use function Folded\addLogger;
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

it("should add a debug log in the file log through the addLog function", function (): void {
    $log = "my debug log";
    $path = __DIR__ . "/misc/logs/debug.log";

    addLogger("file", CHANNEL_FILE, [
        "path" => $path,
    ]);
    addLog("file", SEVERITY_DEBUG, $log);

    expect(getFileContent($path))->toContain("file.DEBUG: $log");
});
