<?php

declare(strict_types=1);

namespace Tests\DateType\ImmutableDate;

use DateType\ImmutableDate;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AddYearsTest extends TestCase
{
    #[Test]
    public function addAYear(): void
    {
        $date = new ImmutableDate('2025-01-01 10:30:45.080607');

        $modified = $date->addYears(1);

        $this->assertSame('2026-01-01 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertNotSame($date, $modified);
        $this->assertNotSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function addYears(): void
    {
        $date = new ImmutableDate('2025-01-01 10:30:45.080607');

        $modified = $date->addYears(5);

        $this->assertSame('2030-01-01 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertNotSame($date, $modified);
        $this->assertNotSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function addYearFromLeapYear(): void
    {
        $date = new ImmutableDate('2024-02-29 10:30:45.080607');

        $modified = $date->addYears(1);

        $this->assertSame('2025-02-28 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertNotSame($date, $modified);
        $this->assertNotSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function addAYearWithNegativeValue(): void
    {
        $date = new ImmutableDate('2025-01-01 10:30:45.080607');

        $modified = $date->addYears(-1);

        $this->assertSame('2024-01-01 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertNotSame($date, $modified);
        $this->assertNotSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function addYearsWithNegativeValue(): void
    {
        $date = new ImmutableDate('2025-01-01 10:30:45.080607');

        $modified = $date->addYears(-5);

        $this->assertSame('2020-01-01 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertNotSame($date, $modified);
        $this->assertNotSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function addYearFromLeapYearWithNegativeValue(): void
    {
        $date = new ImmutableDate('2024-02-29 10:30:45.080607');

        $modified = $date->addYears(-1);

        $this->assertSame('2023-02-28 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertNotSame($date, $modified);
        $this->assertNotSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }
}
