<?php

declare(strict_types=1);

namespace Tests\DateType\MutableDate;

use DateType\MutableDate;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AddMonthsTest extends TestCase
{
    #[Test]
    public function addAMonth(): void
    {
        $date = new MutableDate('2025-01-01 10:30:45.080607');

        $modified = $date->addMonths(1);

        $this->assertSame('2025-02-01 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertSame($date, $modified);
        $this->assertSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function addMonths(): void
    {
        $date = new MutableDate('2025-01-01 10:30:45.080607');

        $modified = $date->addMonths(5);

        $this->assertSame('2025-06-01 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertSame($date, $modified);
        $this->assertSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function addMonthAdjustsToLastDayWhenTargetMonthIsShorter(): void
    {
        $date = new MutableDate('2024-01-31 10:30:45.080607');

        $modified = $date->addMonths(1);

        $this->assertSame('2024-02-29 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertSame($date, $modified);
        $this->assertSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function addAMonthWithNegativeValue(): void
    {
        $date = new MutableDate('2025-01-01 10:30:45.080607');

        $modified = $date->addMonths(-1);

        $this->assertSame('2024-12-01 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertSame($date, $modified);
        $this->assertSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function addMonthsWithNegativeValue(): void
    {
        $date = new MutableDate('2025-01-01 10:30:45.080607');

        $modified = $date->addMonths(-5);

        $this->assertSame('2024-08-01 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertSame($date, $modified);
        $this->assertSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function addMonthAdjustsToLastDayWhenTargetMonthIsShorterWithNegativeValue(): void
    {
        $date = new MutableDate('2024-03-31 10:30:45.080607');

        $modified = $date->addMonths(-1);

        $this->assertSame('2024-02-29 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertSame($date, $modified);
        $this->assertSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }
}
