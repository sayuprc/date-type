<?php

declare(strict_types=1);

namespace Tests\DateType\MutableDate;

use DateTime;
use DateTimeImmutable;
use DateType\ImmutableDate;
use DateType\MutableDate;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class IsBeforeOrEqualTest extends TestCase
{
    #[Test]
    public function isBeforeOrEqualTrueWithMutableDate(): void
    {
        $this->assertTrue(new MutableDate('2025-01-01')->isBeforeOrEqual(new MutableDate('2025-01-02 20:38:19.382290')));
    }

    #[Test]
    public function isBeforeOrEqualTrueWithImmutableDate(): void
    {
        $this->assertTrue(new MutableDate('2025-01-01')->isBeforeOrEqual(new ImmutableDate('2025-01-02 20:38:19.382290')));
    }

    #[Test]
    public function isBeforeOrEqualTrueWithDateTime(): void
    {
        $this->assertTrue(new MutableDate('2025-01-01')->isBeforeOrEqual(new DateTime('2025-01-02 20:38:19.382290')));
    }

    #[Test]
    public function isBeforeOrEqualTrueWithDateTimeImmutable(): void
    {
        $this->assertTrue(new MutableDate('2025-01-01')->isBeforeOrEqual(new DateTimeImmutable('2025-01-02 20:38:19.382290')));
    }

    #[Test]
    public function isBeforeOrEqualTrueWithEqualMutableDate(): void
    {
        $this->assertTrue(new MutableDate('2025-01-01')->isBeforeOrEqual(new MutableDate('2025-01-01 20:38:19.382290')));
    }

    #[Test]
    public function isBeforeOrEqualTrueWithEqualImmutableDate(): void
    {
        $this->assertTrue(new MutableDate('2025-01-01')->isBeforeOrEqual(new ImmutableDate('2025-01-01 20:38:19.382290')));
    }

    #[Test]
    public function isBeforeOrEqualTrueWithEqualDateTime(): void
    {
        $this->assertTrue(new MutableDate('2025-01-01')->isBeforeOrEqual(new DateTime('2025-01-01 20:38:19.382290')));
    }

    #[Test]
    public function isBeforeOrEqualTrueWithEqualDateTimeImmutable(): void
    {
        $this->assertTrue(new MutableDate('2025-01-01')->isBeforeOrEqual(new DateTimeImmutable('2025-01-01 20:38:19.382290')));
    }

    #[Test]
    public function isBeforeOrEqualFalseWithFutureMutableDate(): void
    {
        $this->assertFalse(new MutableDate('2025-01-01')->isBeforeOrEqual(new MutableDate('2024-12-31 20:38:19.382290')));
    }

    #[Test]
    public function isBeforeOrEqualFalseWithFutureImmutableDate(): void
    {
        $this->assertFalse(new MutableDate('2025-01-01')->isBeforeOrEqual(new ImmutableDate('2024-12-31 20:38:19.382290')));
    }

    #[Test]
    public function isBeforeOrEqualFalseWithFutureDateTime(): void
    {
        $this->assertFalse(new MutableDate('2025-01-01')->isBeforeOrEqual(new DateTime('2024-12-31 20:38:19.382290')));
    }

    #[Test]
    public function isBeforeOrEqualFalseWithFutureDateTimeImmutable(): void
    {
        $this->assertFalse(new MutableDate('2025-01-01')->isBeforeOrEqual(new DateTimeImmutable('2024-12-31 20:38:19.382290')));
    }
}
