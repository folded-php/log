<?php

declare(strict_types = 1);

use Folded\Logger;
use function Folded\addEmergencyLog;
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

it("should add an emergency in the file log", function (): void {
    $log = "my emergency log";
    $path = __DIR__ . "/misc/logs/emergency.log";

    addLogger("file", CHANNEL_FILE, [
        "path" => $path,
    ]);
    addEmergencyLog("file", $log);

    expect(getFileContent($path))->toContain("file.EMERGENCY: $log");
});
