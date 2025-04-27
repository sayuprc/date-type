<?php

declare(strict_types=1);

namespace DateType\ImmutableDate;

use DateType\ImmutableDate;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SubMonthsTest extends TestCase
{
    #[Test]
    public function subAMonth(): void
    {
        $date = new ImmutableDate('2025-01-01 10:30:45.080607');

        $modified = $date->subMonths(1);

        $this->assertSame('2024-12-01 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertNotSame($date, $modified);
        $this->assertNotSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function subMonths(): void
    {
        $date = new ImmutableDate('2025-01-01 10:30:45.080607');

        $modified = $date->subMonths(5);

        $this->assertSame('2024-08-01 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertNotSame($date, $modified);
        $this->assertNotSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function subMonthAdjustsToLastDayWhenTargetMonthIsShorter(): void
    {
        $date = new ImmutableDate('2025-01-31 10:30:45.080607');

        $modified = $date->subMonths(2);

        $this->assertSame('2024-11-30 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertNotSame($date, $modified);
        $this->assertNotSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function subAMonthWithNegativeValue(): void
    {
        $date = new ImmutableDate('2025-01-01 10:30:45.080607');

        $modified = $date->subMonths(-1);

        $this->assertSame('2025-02-01 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertNotSame($date, $modified);
        $this->assertNotSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function subMonthsWithNegativeValue(): void
    {
        $date = new ImmutableDate('2025-01-01 10:30:45.080607');

        $modified = $date->subMonths(-5);

        $this->assertSame('2025-06-01 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertNotSame($date, $modified);
        $this->assertNotSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function subMonthAdjustsToLastDayWhenTargetMonthIsShorterWithNegativeValue(): void
    {
        $date = new ImmutableDate('2025-01-31 10:30:45.080607');

        $modified = $date->subMonths(-1);

        $this->assertSame('2025-02-28 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertNotSame($date, $modified);
        $this->assertNotSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }
}
