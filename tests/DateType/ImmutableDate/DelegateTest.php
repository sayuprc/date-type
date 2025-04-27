<?php

declare(strict_types=1);

namespace Tests\DateType\ImmutableDate;

use DateTimeZone;
use DateType\ImmutableDate;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DelegateTest extends TestCase
{
    #[Test]
    #[DataProvider('provide')]
    public function format(string $datetime, string $format, string $expected): void
    {
        $this->assertSame($expected, new ImmutableDate($datetime)->format($format));
    }

    public static function provide(): array
    {
        return [
            ['2025-01-01', 'Y-m-d', '2025-01-01'],
            ['2025-01-01', 'Y/m/d', '2025/01/01'],
            ['2025-01-01', 'Y-m-d H:i:s', '2025-01-01 00:00:00'],
            ['2025-01-01', 'Y-m-d H:i:s.u', '2025-01-01 00:00:00.000000'],
        ];
    }

    #[Test]
    public function getMicrosecondIsAlwaysZero(): void
    {
        $this->assertSame(0, new ImmutableDate('2025-01-01 10:30:45.080607')->getMicrosecond());
    }

    #[Test]
    public function getTimestamp(): void
    {
        $this->assertSame(1735657200, new ImmutableDate('2025-01-01 10:30:45.080607', new DateTimeZone('Asia/Tokyo'))->getTimestamp());
    }

    #[Test]
    public function getTimezone(): void
    {
        $date = new ImmutableDate('2025-01-01 10:30:45.080607', new DateTimeZone('Asia/Tokyo'));

        $this->assertSame('Asia/Tokyo', $date->getTimezone()->getName());
    }

    #[Test]
    public function getOffset(): void
    {
        $date = new ImmutableDate('2025-01-01 10:30:45.080607', new DateTimeZone('Asia/Tokyo'));

        $this->assertSame(32400, $date->getOffset());
    }
}
