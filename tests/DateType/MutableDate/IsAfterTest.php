<?php

declare(strict_types=1);

namespace Tests\DateType\MutableDate;

use DateTime;
use DateTimeImmutable;
use DateType\ImmutableDate;
use DateType\MutableDate;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class IsAfterTest extends TestCase
{
    #[Test]
    public function isAfterTrueWithMutableDate(): void
    {
        $this->assertTrue(new MutableDate('2025-01-02')->isAfter(new MutableDate('2025-01-01 20:38:19.382290')));
    }

    #[Test]
    public function isAfterTrueWithImmutableDate(): void
    {
        $this->assertTrue(new MutableDate('2025-01-02')->isAfter(new ImmutableDate('2025-01-01 20:38:19.382290')));
    }

    #[Test]
    public function isAfterTrueWithDateTime(): void
    {
        $this->assertTrue(new MutableDate('2025-01-02')->isAfter(new DateTime('2025-01-01 20:38:19.382290')));
    }

    #[Test]
    public function isAfterTrueWithDateTimeImmutable(): void
    {
        $this->assertTrue(new MutableDate('2025-01-02')->isAfter(new DateTimeImmutable('2025-01-01 20:38:19.382290')));
    }

    #[Test]
    public function isAfterFalseWithEqualMutableDate(): void
    {
        $this->assertFalse(new MutableDate('2025-01-01')->isAfter(new MutableDate('2025-01-01 20:38:19.382290')));
    }

    #[Test]
    public function isAfterFalseWithEqualImmutableDate(): void
    {
        $this->assertFalse(new MutableDate('2025-01-01')->isAfter(new ImmutableDate('2025-01-01 20:38:19.382290')));
    }

    #[Test]
    public function isAfterFalseWithEqualDateTime(): void
    {
        $this->assertFalse(new MutableDate('2025-01-01')->isAfter(new DateTime('2025-01-01 20:38:19.382290')));
    }

    #[Test]
    public function isAfterFalseWithEqualDateTimeImmutable(): void
    {
        $this->assertFalse(new MutableDate('2025-01-01')->isAfter(new DateTimeImmutable('2025-01-01 20:38:19.382290')));
    }

    #[Test]
    public function isAfterFalseWithPastMutableDate(): void
    {
        $this->assertFalse(new MutableDate('2024-12-31')->isAfter(new MutableDate('2025-01-01 20:38:19.382290')));
    }

    #[Test]
    public function isAfterFalseWithPastImmutableDate(): void
    {
        $this->assertFalse(new MutableDate('2024-12-31')->isAfter(new ImmutableDate('2025-01-01 20:38:19.382290')));
    }

    #[Test]
    public function isAfterFalseWithPastDateTime(): void
    {
        $this->assertFalse(new MutableDate('2024-12-31')->isAfter(new DateTime('2025-01-01 20:38:19.382290')));
    }

    #[Test]
    public function isAfterFalseWithPastDateTimeImmutable(): void
    {
        $this->assertFalse(new MutableDate('2024-12-31')->isAfter(new DateTimeImmutable('2025-01-01 20:38:19.382290')));
    }
}
