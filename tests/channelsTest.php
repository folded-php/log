<?php

declare(strict_types = 1);

use const Folded\CHANNEL_FILE;

it("should return file", function (): void {
    expect(CHANNEL_FILE)->toBe("file");
});
