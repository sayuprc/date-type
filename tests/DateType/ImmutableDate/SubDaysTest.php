<?php

declare(strict_types=1);

namespace DateType\ImmutableDate;

use DateType\ImmutableDate;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SubDaysTest extends TestCase
{
    #[Test]
    public function subADay(): void
    {
        $date = new ImmutableDate('2025-02-01 10:30:45.080607');

        $modified = $date->subDays(1);

        $this->assertSame('2025-01-31 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertNotSame($date, $modified);
        $this->assertNotSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function subDays(): void
    {
        $date = new ImmutableDate('2025-02-01 10:30:45.080607');

        $modified = $date->subDays(5);

        $this->assertSame('2025-01-27 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertNotSame($date, $modified);
        $this->assertNotSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function subADayWithNegativeValue(): void
    {
        $date = new ImmutableDate('2025-01-01 10:30:45.080607');

        $modified = $date->subDays(-1);

        $this->assertSame('2025-01-02 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertNotSame($date, $modified);
        $this->assertNotSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function subDaysWithNegativeValue(): void
    {
        $date = new ImmutableDate('2025-01-01 10:30:45.080607');

        $modified = $date->subDays(-5);

        $this->assertSame('2025-01-06 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertNotSame($date, $modified);
        $this->assertNotSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }
}
