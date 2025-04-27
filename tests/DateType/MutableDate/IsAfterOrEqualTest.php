<?php

declare(strict_types=1);

namespace Tests\DateType\MutableDate;

use DateTime;
use DateTimeImmutable;
use DateType\ImmutableDate;
use DateType\MutableDate;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class IsAfterOrEqualTest extends TestCase
{
    #[Test]
    public function isAfterOrEqualTrueWithMutableDate(): void
    {
        $this->assertTrue(new MutableDate('2025-01-02')->isAfterOrEqual(new MutableDate('2025-01-01 20:38:19.382290')));
    }

    #[Test]
    public function isAfterOrEqualTrueWithImmutableDate(): void
    {
        $this->assertTrue(new MutableDate('2025-01-02')->isAfterOrEqual(new ImmutableDate('2025-01-01 20:38:19.382290')));
    }

    #[Test]
    public function isAfterOrEqualTrueWithDateTime(): void
    {
        $this->assertTrue(new MutableDate('2025-01-02')->isAfterOrEqual(new DateTime('2025-01-01 20:38:19.382290')));
    }

    #[Test]
    public function isAfterOrEqualTrueWithDateTimeImmutable(): void
    {
        $this->assertTrue(new MutableDate('2025-01-02')->isAfterOrEqual(new DateTimeImmutable('2025-01-01 20:38:19.382290')));
    }

    #[Test]
    public function isAfterOrEqualTrueWithEqualMutableDate(): void
    {
        $this->assertTrue(new MutableDate('2025-01-01')->isAfterOrEqual(new MutableDate('2025-01-01 20:38:19.382290')));
    }

    #[Test]
    public function isAfterOrEqualTrueWithEqualImmutableDate(): void
    {
        $this->assertTrue(new MutableDate('2025-01-01')->isAfterOrEqual(new ImmutableDate('2025-01-01 20:38:19.382290')));
    }

    #[Test]
    public function isAfterOrEqualTrueWithEqualDateTime(): void
    {
        $this->assertTrue(new MutableDate('2025-01-01')->isAfterOrEqual(new DateTime('2025-01-01 20:38:19.382290')));
    }

    #[Test]
    public function isAfterOrEqualTrueWithEqualDateTimeImmutable(): void
    {
        $this->assertTrue(new MutableDate('2025-01-01')->isAfterOrEqual(new DateTimeImmutable('2025-01-01 20:38:19.382290')));
    }

    #[Test]
    public function isAfterOrEqualFalseWithPastMutableDate(): void
    {
        $this->assertFalse(new MutableDate('2024-12-31')->isAfterOrEqual(new MutableDate('2025-01-01 20:38:19.382290')));
    }

    #[Test]
    public function isAfterOrEqualFalseWithPastImmutableDate(): void
    {
        $this->assertFalse(new MutableDate('2024-12-31')->isAfterOrEqual(new ImmutableDate('2025-01-01 20:38:19.382290')));
    }

    #[Test]
    public function isAfterOrEqualFalseWithPastDateTime(): void
    {
        $this->assertFalse(new MutableDate('2024-12-31')->isAfterOrEqual(new DateTime('2025-01-01 20:38:19.382290')));
    }

    #[Test]
    public function isAfterOrEqualFalseWithPastDateTimeImmutable(): void
    {
        $this->assertFalse(new MutableDate('2024-12-31')->isAfterOrEqual(new DateTimeImmutable('2025-01-01 20:38:19.382290')));
    }
}
