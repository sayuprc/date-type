<?php

declare(strict_types=1);

namespace Tests\DateType\ImmutableDate;

use DateTime;
use DateType\ImmutableDate;
use DateType\MutableDate;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CreateFromMutableTest extends TestCase
{
    #[Test]
    public function createFromMutableWithDateTime(): void
    {
        $date = ImmutableDate::createFromMutable(new DateTime('2025-01-01 10:30:45.080607'));

        $this->assertInstanceOf(ImmutableDate::class, $date);
        $this->assertSame('2025-01-01 00:00:00.000000', $date->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function createFromMutableWithMutableDate(): void
    {
        $date = ImmutableDate::createFromMutable(new MutableDate('2025-01-01 10:30:45.080607'));

        $this->assertInstanceOf(ImmutableDate::class, $date);
        $this->assertSame('2025-01-01 00:00:00.000000', $date->format(self::DEFAULT_FORMAT));
    }
}
