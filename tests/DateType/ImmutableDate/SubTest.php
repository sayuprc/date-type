<?php

declare(strict_types=1);

namespace DateType\ImmutableDate;

use DateInterval;
use DateType\ImmutableDate;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SubTest extends TestCase
{
    #[Test]
    public function subYear(): void
    {
        $date = new ImmutableDate('2025-01-01 10:30:45.080607');

        $modified = $date->sub(new DateInterval('P1Y'));

        $this->assertSame('2024-01-01 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertNotSame($date, $modified);
        $this->assertNotSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function subYearFromLeapYear(): void
    {
        $date = new ImmutableDate('2024-02-29 10:30:45.080607');

        $modified = $date->sub(new DateInterval('P1Y'));

        $this->assertSame('2023-02-28 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertNotSame($date, $modified);
        $this->assertNotSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function subMonth(): void
    {
        $date = new ImmutableDate('2025-01-01 10:30:45.080607');

        $modified = $date->sub(new DateInterval('P1M'));

        $this->assertSame('2024-12-01 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertNotSame($date, $modified);
        $this->assertNotSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function subMonthAdjustsToLastDayWhenTargetMonthIsShorter(): void
    {
        $date = new ImmutableDate('2025-03-31 10:30:45.080607');

        $modified = $date->sub(new DateInterval('P1M'));

        $this->assertSame('2025-02-28 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertNotSame($date, $modified);
        $this->assertNotSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function subDay(): void
    {
        $date = new ImmutableDate('2025-01-01 10:30:45.080607');

        $modified = $date->sub(new DateInterval('P1D'));

        $this->assertSame('2024-12-31 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertNotSame($date, $modified);
        $this->assertNotSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function noEffect(): void
    {
        $date = new ImmutableDate('2025-01-01 10:30:45.080607');

        $modified = $date->sub(new DateInterval('PT1H1M1S'));

        $this->assertSame('2025-01-01 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertNotSame($date, $modified);
    }

    #[Test]
    public function complex(): void
    {
        $date = new ImmutableDate('2025-01-01 10:30:45.080607');

        $modified = $date->sub(new DateInterval('P1Y1M1DT1H1M1S'));

        $this->assertSame('2023-11-30 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertNotSame($date, $modified);
    }

    #[Test]
    public function subYearWithNegativeValue(): void
    {
        $date = new ImmutableDate('2025-01-01 10:30:45.080607');

        $interval = new DateInterval('P1Y');
        $interval->invert = 1;

        $modified = $date->sub($interval);

        $this->assertSame('2026-01-01 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertNotSame($date, $modified);
        $this->assertNotSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function subYearFromLeapYearWithNegativeValue(): void
    {
        $date = new ImmutableDate('2024-02-29 10:30:45.080607');

        $interval = new DateInterval('P1Y');
        $interval->invert = 1;

        $modified = $date->sub($interval);

        $this->assertSame('2025-02-28 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertNotSame($date, $modified);
        $this->assertNotSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function subMonthWithNegativeValue(): void
    {
        $date = new ImmutableDate('2025-01-01 10:30:45.080607');

        $interval = new DateInterval('P1M');
        $interval->invert = 1;

        $modified = $date->sub($interval);

        $this->assertSame('2025-02-01 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertNotSame($date, $modified);
        $this->assertNotSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function subMonthAdjustsToLastDayWhenTargetMonthIsShorterWithNegativeValue(): void
    {
        $date = new ImmutableDate('2025-03-31 10:30:45.080607');

        $interval = new DateInterval('P1M');
        $interval->invert = 1;

        $modified = $date->sub($interval);

        $this->assertSame('2025-04-30 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertNotSame($date, $modified);
        $this->assertNotSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function subDayWithNegativeValue(): void
    {
        $date = new ImmutableDate('2025-01-01 10:30:45.080607');

        $interval = new DateInterval('P1D');
        $interval->invert = 1;

        $modified = $date->sub($interval);

        $this->assertSame('2025-01-02 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertNotSame($date, $modified);
        $this->assertNotSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }
}
