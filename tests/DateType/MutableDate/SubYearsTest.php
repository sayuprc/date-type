<?php

declare(strict_types=1);

namespace Tests\DateType\MutableDate;

use DateType\MutableDate;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SubYearsTest extends TestCase
{
    #[Test]
    public function subAYear(): void
    {
        $date = new MutableDate('2025-01-01 10:30:45.080607');

        $modified = $date->subYears(1);

        $this->assertSame('2024-01-01 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertSame($date, $modified);
        $this->assertSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function subYears(): void
    {
        $date = new MutableDate('2025-01-01 10:30:45.080607');

        $modified = $date->subYears(5);

        $this->assertSame('2020-01-01 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertSame($date, $modified);
        $this->assertSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function subYearFromLeapYear(): void
    {
        $date = new MutableDate('2024-02-29 10:30:45.080607');

        $modified = $date->subYears(1);

        $this->assertSame('2023-02-28 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertSame($date, $modified);
        $this->assertSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function subAYearWithNegativeValue(): void
    {
        $date = new MutableDate('2025-01-01 10:30:45.080607');

        $modified = $date->subYears(-1);

        $this->assertSame('2026-01-01 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertSame($date, $modified);
        $this->assertSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function subYearsWithNegativeValue(): void
    {
        $date = new MutableDate('2025-01-01 10:30:45.080607');

        $modified = $date->subYears(-5);

        $this->assertSame('2030-01-01 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertSame($date, $modified);
        $this->assertSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function subYearFromLeapYearWithNegativeValue(): void
    {
        $date = new MutableDate('2024-02-29 10:30:45.080607');

        $modified = $date->subYears(-1);

        $this->assertSame('2025-02-28 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertSame($date, $modified);
        $this->assertSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }
}
