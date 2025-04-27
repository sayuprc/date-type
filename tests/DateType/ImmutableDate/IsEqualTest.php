<?php

declare(strict_types=1);

namespace Tests\DateType\ImmutableDate;

use DateTime;
use DateTimeImmutable;
use DateType\ImmutableDate;
use DateType\MutableDate;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class IsEqualTest extends TestCase
{
    #[Test]
    public function isEqualTrueWithMutableDate(): void
    {
        $this->assertTrue(new ImmutableDate('2025-01-01')->isEqual(new MutableDate('2025-01-01 20:38:19.382290')));
    }

    #[Test]
    public function isEqualTrueWithImmutableDate(): void
    {
        $this->assertTrue(new ImmutableDate('2025-01-01')->isEqual(new ImmutableDate('2025-01-01 20:38:19.382290')));
    }

    #[Test]
    public function isEqualTrueWithDateTime(): void
    {
        $this->assertTrue(new ImmutableDate('2025-01-01')->isEqual(new DateTime('2025-01-01 20:38:19.382290')));
    }

    #[Test]
    public function isEqualTrueWithDateTimeImmutable(): void
    {
        $this->assertTrue(new ImmutableDate('2025-01-01')->isEqual(new DateTimeImmutable('2025-01-01 20:38:19.382290')));
    }

    #[Test]
    public function isEqualFalseWithMutableDate(): void
    {
        $this->assertFalse(new ImmutableDate('2025-01-01')->isEqual(new MutableDate('2025-01-02 20:38:19.382290')));
    }

    #[Test]
    public function isEqualFalseWithImmutableDate(): void
    {
        $this->assertFalse(new ImmutableDate('2025-01-01')->isEqual(new ImmutableDate('2025-01-02 20:38:19.382290')));
    }

    #[Test]
    public function isEqualFalseWithDateTime(): void
    {
        $this->assertFalse(new ImmutableDate('2025-01-01')->isEqual(new DateTime('2025-01-02 20:38:19.382290')));
    }

    #[Test]
    public function isEqualFalseWithDateTimeImmutable(): void
    {
        $this->assertFalse(new ImmutableDate('2025-01-01')->isEqual(new DateTimeImmutable('2025-01-02 20:38:19.382290')));
    }
}
