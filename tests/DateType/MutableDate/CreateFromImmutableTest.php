<?php

declare(strict_types=1);

namespace DateType\MutableDate;

use DateTimeImmutable;
use DateType\ImmutableDate;
use DateType\MutableDate;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CreateFromImmutableTest extends TestCase
{
    #[Test]
    public function createFromMutableWithDateTimeImmutable(): void
    {
        $date = MutableDate::createFromImmutable(new DateTimeImmutable('2025-01-01 10:30:45.080607'));

        $this->assertInstanceOf(MutableDate::class, $date);
        $this->assertSame('2025-01-01 00:00:00.000000', $date->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function createFromMutableWithImmutableDate(): void
    {
        $date = MutableDate::createFromImmutable(new ImmutableDate('2025-01-01 10:30:45.080607'));

        $this->assertInstanceOf(MutableDate::class, $date);
        $this->assertSame('2025-01-01 00:00:00.000000', $date->format(self::DEFAULT_FORMAT));
    }
}
