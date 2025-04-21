<?php

declare(strict_types=1);

namespace Tests;

use DateTime;
use DateType\Date;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class DateTest extends TestCase
{
    #[Test]
    #[DataProvider('provideTimeIsZero')]
    public function timeIsZero(DateTime $value): void
    {
        $this->assertSame($value->format('Y-m-d 00:00:00.000000'), new Date($value)->value->format('Y-m-d 00:00:00.000000'));
    }

    public static function provideTimeIsZero(): array
    {
        return [
            [new DateTime()],
            [new DateTime('2025-01-01 20:15:39')],
            [new DateTime('2025-01-01 20:15:39.000000')],
            [new DateTime('2025-01-01 20:15:39.000001')],
            [new DateTime('2025-01-01 20:15:39.000301')],
        ];
    }
}
