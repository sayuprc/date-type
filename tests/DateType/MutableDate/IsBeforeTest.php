<?php

declare(strict_types=1);

namespace Tests\DateType\MutableDate;

use DateTime;
use DateTimeImmutable;
use DateType\ImmutableDate;
use DateType\MutableDate;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class IsBeforeTest extends TestCase
{
    #[Test]
    public function isBeforeTrueWithMutableDate(): void
    {
        $this->assertTrue(new MutableDate('2025-01-01')->isBefore(new MutableDate('2025-01-02 20:38:19.382290')));
    }

    #[Test]
    public function isBeforeTrueWithImmutableDate(): void
    {
        $this->assertTrue(new MutableDate('2025-01-01')->isBefore(new ImmutableDate('2025-01-02 20:38:19.382290')));
    }

    #[Test]
    public function isBeforeTrueWithDateTime(): void
    {
        $this->assertTrue(new MutableDate('2025-01-01')->isBefore(new DateTime('2025-01-02 20:38:19.382290')));
    }

    #[Test]
    public function isBeforeTrueWithDateTimeImmutable(): void
    {
        $this->assertTrue(new MutableDate('2025-01-01')->isBefore(new DateTimeImmutable('2025-01-02 20:38:19.382290')));
    }

    #[Test]
    public function isBeforeFalseWithEqualMutableDate(): void
    {
        $this->assertFalse(new MutableDate('2025-01-01')->isBefore(new MutableDate('2025-01-01 20:38:19.382290')));
    }

    #[Test]
    public function isBeforeFalseWithEqualImmutableDate(): void
    {
        $this->assertFalse(new MutableDate('2025-01-01')->isBefore(new ImmutableDate('2025-01-01 20:38:19.382290')));
    }

    #[Test]
    public function isBeforeFalseWithEqualDateTime(): void
    {
        $this->assertFalse(new MutableDate('2025-01-01')->isBefore(new DateTime('2025-01-01 20:38:19.382290')));
    }

    #[Test]
    public function isBeforeFalseWithEqualDateTimeImmutable(): void
    {
        $this->assertFalse(new MutableDate('2025-01-01')->isBefore(new DateTimeImmutable('2025-01-01 20:38:19.382290')));
    }

    #[Test]
    public function isBeforeFalseWithFutureMutableDate(): void
    {
        $this->assertFalse(new MutableDate('2025-01-01')->isBefore(new MutableDate('2024-12-31 20:38:19.382290')));
    }

    #[Test]
    public function isBeforeFalseWithFutureImmutableDate(): void
    {
        $this->assertFalse(new MutableDate('2025-01-01')->isBefore(new ImmutableDate('2024-12-31 20:38:19.382290')));
    }

    #[Test]
    public function isBeforeFalseWithFutureDateTime(): void
    {
        $this->assertFalse(new MutableDate('2025-01-01')->isBefore(new DateTime('2024-12-31 20:38:19.382290')));
    }

    #[Test]
    public function isBeforeFalseWithFutureDateTimeImmutable(): void
    {
        $this->assertFalse(new MutableDate('2025-01-01')->isBefore(new DateTimeImmutable('2024-12-31 20:38:19.382290')));
    }
}
