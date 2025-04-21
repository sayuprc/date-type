<?php

declare(strict_types=1);

namespace Tests;

use DateTimeImmutable;
use DateType\DateImmutable;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class DateImmutableTest extends TestCase
{
    #[Test]
    #[DataProvider('provideTimeIsZero')]
    public function timeIsZero(DateTimeImmutable $value): void
    {
        $this->assertSame($value->format('Y-m-d 00:00:00.000000'), new DateImmutable($value)->value->format('Y-m-d 00:00:00.000000'));
    }

    public static function provideTimeIsZero(): array
    {
        return [
            [new DateTimeImmutable()],
            [new DateTimeImmutable('2025-01-01 20:15:39')],
            [new DateTimeImmutable('2025-01-01 20:15:39.000000')],
            [new DateTimeImmutable('2025-01-01 20:15:39.000001')],
            [new DateTimeImmutable('2025-01-01 20:15:39.000301')],
        ];
    }
}
