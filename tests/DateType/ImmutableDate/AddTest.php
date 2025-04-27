<?php

declare(strict_types=1);

namespace Tests\DateType\ImmutableDate;

use DateInterval;
use DateType\ImmutableDate;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AddTest extends TestCase
{
    #[Test]
    public function addYear(): void
    {
        $date = new ImmutableDate('2025-01-01 10:30:45.080607');

        $modified = $date->add(new DateInterval('P1Y'));

        $this->assertSame('2026-01-01 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertNotSame($date, $modified);
        $this->assertNotSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function addYearFromLeapYear(): void
    {
        $date = new ImmutableDate('2024-02-29 10:30:45.080607');

        $modified = $date->add(new DateInterval('P1Y'));

        $this->assertSame('2025-02-28 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertNotSame($date, $modified);
        $this->assertNotSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function addMonth(): void
    {
        $date = new ImmutableDate('2025-01-01 10:30:45.080607');

        $modified = $date->add(new DateInterval('P1M'));

        $this->assertSame('2025-02-01 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertNotSame($date, $modified);
        $this->assertNotSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function addMonthAdjustsToLastDayWhenTargetMonthIsShorter(): void
    {
        $date = new ImmutableDate('2025-01-31 10:30:45.080607');

        $modified = $date->add(new DateInterval('P1M'));

        $this->assertSame('2025-02-28 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertNotSame($date, $modified);
        $this->assertNotSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function addDay(): void
    {
        $date = new ImmutableDate('2025-01-01 10:30:45.080607');

        $modified = $date->add(new DateInterval('P1D'));

        $this->assertSame('2025-01-02 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertNotSame($date, $modified);
        $this->assertNotSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function noEffect(): void
    {
        $date = new ImmutableDate('2025-01-01 10:30:45.080607');

        $modified = $date->add(new DateInterval('PT1H1M1S'));

        $this->assertSame('2025-01-01 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertNotSame($date, $modified);
    }

    #[Test]
    public function complex(): void
    {
        $date = new ImmutableDate('2025-01-01 10:30:45.080607');

        $modified = $date->add(new DateInterval('P1Y1M1DT1H1M1S'));

        $this->assertSame('2026-02-02 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertNotSame($date, $modified);
    }

    #[Test]
    public function addYearWithNegativeValue(): void
    {
        $date = new ImmutableDate('2025-01-01 10:30:45.080607');

        $interval = new DateInterval('P1Y');
        $interval->invert = 1;

        $modified = $date->add($interval);

        $this->assertSame('2024-01-01 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertNotSame($date, $modified);
        $this->assertNotSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function addYearFromLeapYearWithNegativeValue(): void
    {
        $date = new ImmutableDate('2024-02-29 10:30:45.080607');

        $interval = new DateInterval('P1Y');
        $interval->invert = 1;

        $modified = $date->add($interval);

        $this->assertSame('2023-02-28 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertNotSame($date, $modified);
        $this->assertNotSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function addMonthWithNegativeValue(): void
    {
        $date = new ImmutableDate('2025-01-01 10:30:45.080607');

        $interval = new DateInterval('P1M');
        $interval->invert = 1;

        $modified = $date->add($interval);

        $this->assertSame('2024-12-01 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertNotSame($date, $modified);
        $this->assertNotSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function addMonthAdjustsToLastDayWhenTargetMonthIsShorterWithNegativeValue(): void
    {
        $date = new ImmutableDate('2025-03-31 10:30:45.080607');

        $interval = new DateInterval('P1M');
        $interval->invert = 1;

        $modified = $date->add($interval);

        $this->assertSame('2025-02-28 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertNotSame($date, $modified);
        $this->assertNotSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function addDayWithNegativeValue(): void
    {
        $date = new ImmutableDate('2025-01-01 10:30:45.080607');

        $interval = new DateInterval('P1D');
        $interval->invert = 1;

        $modified = $date->add($interval);

        $this->assertSame('2024-12-31 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertNotSame($date, $modified);
        $this->assertNotSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }
}
