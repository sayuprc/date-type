<?php

declare(strict_types=1);

namespace Tests\DateType\MutableDate;

use DateType\MutableDate;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SubDaysTest extends TestCase
{
    #[Test]
    public function subADay(): void
    {
        $date = new MutableDate('2025-02-01 10:30:45.080607');

        $modified = $date->subDays(1);

        $this->assertSame('2025-01-31 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertSame($date, $modified);
        $this->assertSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function subDays(): void
    {
        $date = new MutableDate('2025-02-01 10:30:45.080607');

        $modified = $date->subDays(5);

        $this->assertSame('2025-01-27 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertSame($date, $modified);
        $this->assertSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function subADayWithNegativeValue(): void
    {
        $date = new MutableDate('2025-01-01 10:30:45.080607');

        $modified = $date->subDays(-1);

        $this->assertSame('2025-01-02 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertSame($date, $modified);
        $this->assertSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function subDaysWithNegativeValue(): void
    {
        $date = new MutableDate('2025-01-01 10:30:45.080607');

        $modified = $date->subDays(-5);

        $this->assertSame('2025-01-06 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertSame($date, $modified);
        $this->assertSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }
}
