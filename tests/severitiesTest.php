<?php

declare(strict_types = 1);

use const Folded\SEVERITY_ALERT;
use const Folded\SEVERITY_CRITICAL;
use const Folded\SEVERITY_DEBUG;
use const Folded\SEVERITY_EMERGENCY;
use const Folded\SEVERITY_ERROR;
use const Folded\SEVERITY_INFO;
use const Folded\SEVERITY_NOTICE;
use const Folded\SEVERITY_WARNING;

it("should return alert", function (): void {
    expect(SEVERITY_ALERT)->toBe("alert");
});

it("should return critical", function (): void {
    expect(SEVERITY_CRITICAL)->toBe("critical");
});

it("should return debug", function (): void {
    expect(SEVERITY_DEBUG)->toBe("debug");
});

it("should return emergency", function (): void {
    expect(SEVERITY_EMERGENCY)->toBe("emergency");
});

it("should return info", function (): void {
    expect(SEVERITY_INFO)->toBe("info");
});

it("should return error", function (): void {
    expect(SEVERITY_ERROR)->toBe("error");
});

it("should return notice", function (): void {
    expect(SEVERITY_NOTICE)->toBe("notice");
});

it("should return warning", function (): void {
    expect(SEVERITY_WARNING)->toBe("warning");
});
