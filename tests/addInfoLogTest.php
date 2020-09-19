<?php

declare(strict_types = 1);

use Folded\Logger;
use function Folded\addInfoLog;
use const Folded\CHANNEL_FILE;
use function Folded\addLogger;

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

it("should add an info in the file log", function (): void {
    $log = "my info log";
    $path = __DIR__ . "/misc/logs/info.log";

    addLogger("file", CHANNEL_FILE, [
        "path" => $path,
    ]);
    addInfoLog("file", $log);

    expect(getFileContent($path))->toContain("file.INFO: $log");
});
