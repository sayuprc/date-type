<?php

declare(strict_types=1);

namespace Tests;

use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use DateTimeZone;
use DateType\Date;
use DateType\DateImmutable;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class DateTest extends TestCase
{
    #[Test]
    #[DataProvider('provideTimeIsZero')]
    public function timeIsZero(Date|DateImmutable|DateTimeInterface|string $datetime, ?DateTimeZone $timezone, string $expected): void
    {
        $this->assertSame($expected, new Date($datetime, $timezone)->format('Y-m-d 00:00:00.000000'));
    }

    public static function provideTimeIsZero(): array
    {
        return [
            [new Date('2025-01-01 20:15:39'), null, '2025-01-01 00:00:00.000000'],
            [new Date('2025-01-01 20:15:39.000000'), null, '2025-01-01 00:00:00.000000'],
            [new Date('2025-01-01 20:15:39.000001'), null, '2025-01-01 00:00:00.000000'],
            [new Date('2025-01-01 20:15:39.000301'), null, '2025-01-01 00:00:00.000000'],
            [new DateImmutable('2025-01-01 20:15:39'), null, '2025-01-01 00:00:00.000000'],
            [new DateImmutable('2025-01-01 20:15:39.000000'), null, '2025-01-01 00:00:00.000000'],
            [new DateImmutable('2025-01-01 20:15:39.000001'), null, '2025-01-01 00:00:00.000000'],
            [new DateImmutable('2025-01-01 20:15:39.000301'), null, '2025-01-01 00:00:00.000000'],
            [new DateTime('2025-01-01 20:15:39'), null, '2025-01-01 00:00:00.000000'],
            [new DateTime('2025-01-01 20:15:39.000000'), null, '2025-01-01 00:00:00.000000'],
            [new DateTime('2025-01-01 20:15:39.000001'), null, '2025-01-01 00:00:00.000000'],
            [new DateTime('2025-01-01 20:15:39.000301'), null, '2025-01-01 00:00:00.000000'],
            [new DateTimeImmutable('2025-01-01 20:15:39'), null, '2025-01-01 00:00:00.000000'],
            [new DateTimeImmutable('2025-01-01 20:15:39.000000'), null, '2025-01-01 00:00:00.000000'],
            [new DateTimeImmutable('2025-01-01 20:15:39.000001'), null, '2025-01-01 00:00:00.000000'],
            [new DateTimeImmutable('2025-01-01 20:15:39.000301'), null, '2025-01-01 00:00:00.000000'],
            ['2025-01-01 20:15:39', null, '2025-01-01 00:00:00.000000'],
            ['2025-01-01 20:15:39.000000', null, '2025-01-01 00:00:00.000000'],
            ['2025-01-01 20:15:39.000001', null, '2025-01-01 00:00:00.000000'],
            ['2025-01-01 20:15:39.000301', null, '2025-01-01 00:00:00.000000'],
        ];
    }

    #[Test]
    #[DataProvider('provideAddYears')]
    public function addYears(string $datetime, int $year, string $expected): void
    {
        $date = new Date($datetime);

        $modifiedDate = $date->addYears($year);

        $this->assertSame($expected, $modifiedDate->format('Y-m-d'));
        $this->assertSame($date->format('Y-m-d'), $modifiedDate->format('Y-m-d'));
    }

    public static function provideAddYears(): array
    {
        return [
            ['2025-01-01', 1, '2026-01-01'],
            ['2024-02-29', 1, '2025-02-28'],
            ['2025-01-01', -1, '2026-01-01'],
            ['2024-02-29', -1, '2025-02-28'],
        ];
    }

    #[Test]
    #[DataProvider('provideAddMonths')]
    public function addMonths(string $datetime, int $month, string $expected): void
    {
        $date = new Date($datetime);

        $modifiedDate = $date->addMonths($month);

        $this->assertSame($expected, $modifiedDate->format('Y-m-d'));
        $this->assertSame($date->format('Y-m-d'), $modifiedDate->format('Y-m-d'));
    }

    public static function provideAddMonths(): array
    {
        return [
            ['2025-01-01', 1, '2025-02-01'],
            ['2025-01-31', 1, '2025-02-28'],
            ['2025-01-01', -1, '2025-02-01'],
            ['2025-01-31', -1, '2025-02-28'],
        ];
    }

    #[Test]
    #[DataProvider('provideAddDays')]
    public function addDays(string $datetime, int $day, string $expected): void
    {
        $date = new Date($datetime);

        $modifiedDate = $date->addDays($day);

        $this->assertSame($expected, $modifiedDate->format('Y-m-d'));
        $this->assertSame($date->format('Y-m-d'), $modifiedDate->format('Y-m-d'));
    }

    public static function provideAddDays(): array
    {
        return [
            ['2025-01-01', 1, '2025-01-02'],
            ['2025-01-01', 30, '2025-01-31'],
            ['2025-02-28', 30, '2025-03-30'],
            ['2025-02-28', 32, '2025-04-01'],
            ['2025-01-01', -1, '2025-01-02'],
            ['2025-01-01', -30, '2025-01-31'],
            ['2025-02-28', -30, '2025-03-30'],
            ['2025-02-28', -32, '2025-04-01'],
        ];
    }

    #[Test]
    #[DataProvider('provideSubYears')]
    public function subYears(string $datetime, int $year, string $expected): void
    {
        $date = new Date($datetime);

        $modifiedDate = $date->subYears($year);

        $this->assertSame($expected, $modifiedDate->format('Y-m-d'));
        $this->assertSame($date->format('Y-m-d'), $modifiedDate->format('Y-m-d'));
    }

    public static function provideSubYears(): array
    {
        return [
            ['2025-01-01', 1, '2024-01-01'],
            ['2024-02-29', 1, '2023-02-28'],
            ['2120-02-29', 20, '2100-02-28'],
            ['2025-01-01', -1, '2024-01-01'],
            ['2024-02-29', -1, '2023-02-28'],
            ['2120-02-29', -20, '2100-02-28'],
        ];
    }

    #[Test]
    #[DataProvider('provideSubMonths')]
    public function subMonths(string $datetime, int $month, string $expected): void
    {
        $date = new Date($datetime);

        $modifiedDate = $date->subMonths($month);

        $this->assertSame($expected, $modifiedDate->format('Y-m-d'));
        $this->assertSame($date->format('Y-m-d'), $modifiedDate->format('Y-m-d'));
    }

    public static function provideSubMonths(): array
    {
        return [
            ['2025-01-01', 1, '2024-12-01'],
            ['2025-01-31', 2, '2024-11-30'],
            ['2024-02-29', 12, '2023-02-28'],
            ['2025-01-01', -1, '2024-12-01'],
            ['2025-01-31', -2, '2024-11-30'],
            ['2024-02-29', -12, '2023-02-28'],
        ];
    }

    #[Test]
    #[DataProvider('provideSubDays')]
    public function subDays(string $datetime, int $day, string $expected): void
    {
        $date = new Date($datetime);

        $modifiedDate = $date->subDays($day);

        $this->assertSame($expected, $modifiedDate->format('Y-m-d'));
        $this->assertSame($date->format('Y-m-d'), $modifiedDate->format('Y-m-d'));
    }

    public static function provideSubDays(): array
    {
        return [
            ['2025-01-01', 1, '2024-12-31'],
            ['2025-01-01', 30, '2024-12-02'],
            ['2025-01-01', 60, '2024-11-02'],
            ['2025-01-01', -1, '2024-12-31'],
            ['2025-01-01', -30, '2024-12-02'],
            ['2025-01-01', -60, '2024-11-02'],
        ];
    }

    #[Test]
    #[DataProvider('provideDiff')]
    public function diff(string $datetime, Date|DateImmutable|DateTimeInterface $targetObject, bool $absolute, int $expected): void
    {
        $this->assertSame($expected, new Date($datetime)->diff($targetObject, $absolute)->days);
    }

    public static function provideDiff(): array
    {
        return [
            ['2025-01-01', new Date('2025-01-02'), false, 1],
            ['2025-01-01', new Date('2025-01-02'), true, 1],
            ['2025-01-02', new Date('2025-01-01'), false, 1],
            ['2025-01-02', new Date('2025-01-01'), true, 1],
        ];
    }

    #[Test]
    #[DataProvider('provideIsSame')]
    public function isSame(string $datetime, Date|DateImmutable|DateTimeInterface $other, bool $expected): void
    {
        $this->assertSame($expected, new Date($datetime)->isSame($other));
    }

    public static function provideIsSame(): array
    {
        return [
            ['2025-01-01', new Date('2025-01-01'), true],
            ['2025-01-01', new DateImmutable('2025-01-01'), true],
            ['2025-01-01', new DateTime('2025-01-01'), true],
            ['2025-01-01', new DateTimeImmutable('2025-01-01'), true],
            ['2025-01-01 20:38:19.382290', new Date('2025-01-01 20:38:19.382290'), true],
            ['2025-01-01 20:38:19.382290', new DateImmutable('2025-01-01 20:38:19.382290'), true],
            ['2025-01-01 20:38:19.382290', new DateTime('2025-01-01 20:38:19.382290'), true],
            ['2025-01-01 20:38:19.382290', new DateTimeImmutable('2025-01-01 20:38:19.382290'), true],
            ['2025-01-01 00:00:00.000000', new Date('2025-01-01 20:38:19.382290'), true],
            ['2025-01-01 00:00:00.000000', new DateImmutable('2025-01-01 20:38:19.382290'), true],
            ['2025-01-01 00:00:00.000000', new DateTime('2025-01-01 20:38:19.382290'), true],
            ['2025-01-01 00:00:00.000000', new DateTimeImmutable('2025-01-01 20:38:19.382290'), true],
            ['2025-01-01', new Date('2025-01-02'), false],
            ['2025-01-01', new DateImmutable('2025-01-02'), false],
            ['2025-01-01', new DateTime('2025-01-02'), false],
            ['2025-01-01', new DateTimeImmutable('2025-01-02'), false],
            ['2025-01-01 20:38:19.382290', new Date('2025-01-02 20:38:19.382290'), false],
            ['2025-01-01 20:38:19.382290', new DateImmutable('2025-01-02 20:38:19.382290'), false],
            ['2025-01-01 20:38:19.382290', new DateTime('2025-01-02 20:38:19.382290'), false],
            ['2025-01-01 20:38:19.382290', new DateTimeImmutable('2025-01-02 20:38:19.382290'), false],
            ['2025-01-01 00:00:00.000000', new Date('2025-01-02 20:38:19.382290'), false],
            ['2025-01-01 00:00:00.000000', new DateImmutable('2025-01-02 20:38:19.382290'), false],
            ['2025-01-01 00:00:00.000000', new DateTime('2025-01-02 20:38:19.382290'), false],
            ['2025-01-01 00:00:00.000000', new DateTimeImmutable('2025-01-02 20:38:19.382290'), false],
        ];
    }

    #[Test]
    #[DataProvider('provideIsBefore')]
    public function isBefore(string $datetime, Date|DateImmutable|DateTimeInterface $other, bool $expected): void
    {
        $this->assertSame($expected, new Date($datetime)->isBefore($other));
    }

    public static function provideIsBefore(): array
    {
        return [
            ['2025-01-01', new Date('2025-01-01'), false],
            ['2025-01-01', new DateImmutable('2025-01-01'), false],
            ['2025-01-01', new DateTime('2025-01-01'), false],
            ['2025-01-01', new DateTimeImmutable('2025-01-01'), false],
            ['2025-01-01 20:38:19.382290', new Date('2025-01-01 20:38:19.382290'), false],
            ['2025-01-01 20:38:19.382290', new DateImmutable('2025-01-01 20:38:19.382290'), false],
            ['2025-01-01 20:38:19.382290', new DateTime('2025-01-01 20:38:19.382290'), false],
            ['2025-01-01 20:38:19.382290', new DateTimeImmutable('2025-01-01 20:38:19.382290'), false],
            ['2025-01-01 00:00:00.000000', new Date('2025-01-01 20:38:19.382290'), false],
            ['2025-01-01 00:00:00.000000', new DateImmutable('2025-01-01 20:38:19.382290'), false],
            ['2025-01-01 00:00:00.000000', new DateTime('2025-01-01 20:38:19.382290'), false],
            ['2025-01-01 00:00:00.000000', new DateTimeImmutable('2025-01-01 20:38:19.382290'), false],
            ['2025-01-01', new Date('2025-01-02'), true],
            ['2025-01-01', new DateImmutable('2025-01-02'), true],
            ['2025-01-01', new DateTime('2025-01-02'), true],
            ['2025-01-01', new DateTimeImmutable('2025-01-02'), true],
            ['2025-01-01 20:38:19.382290', new Date('2025-01-02 20:38:19.382290'), true],
            ['2025-01-01 20:38:19.382290', new DateImmutable('2025-01-02 20:38:19.382290'), true],
            ['2025-01-01 20:38:19.382290', new DateTime('2025-01-02 20:38:19.382290'), true],
            ['2025-01-01 20:38:19.382290', new DateTimeImmutable('2025-01-02 20:38:19.382290'), true],
            ['2025-01-01 00:00:00.000000', new Date('2025-01-02 20:38:19.382290'), true],
            ['2025-01-01 00:00:00.000000', new DateImmutable('2025-01-02 20:38:19.382290'), true],
            ['2025-01-01 00:00:00.000000', new DateTime('2025-01-02 20:38:19.382290'), true],
            ['2025-01-01 00:00:00.000000', new DateTimeImmutable('2025-01-02 20:38:19.382290'), true],
            ['2025-01-02', new Date('2025-01-01'), false],
            ['2025-01-02', new DateImmutable('2025-01-01'), false],
            ['2025-01-02', new DateTime('2025-01-01'), false],
            ['2025-01-02', new DateTimeImmutable('2025-01-01'), false],
            ['2025-01-02 20:38:19.382290', new Date('2025-01-01 20:38:19.382290'), false],
            ['2025-01-02 20:38:19.382290', new DateImmutable('2025-01-01 20:38:19.382290'), false],
            ['2025-01-02 20:38:19.382290', new DateTime('2025-01-01 20:38:19.382290'), false],
            ['2025-01-02 20:38:19.382290', new DateTimeImmutable('2025-01-01 20:38:19.382290'), false],
            ['2025-01-02 00:00:00.000000', new Date('2025-01-01 20:38:19.382290'), false],
            ['2025-01-02 00:00:00.000000', new DateImmutable('2025-01-01 20:38:19.382290'), false],
            ['2025-01-02 00:00:00.000000', new DateTime('2025-01-01 20:38:19.382290'), false],
            ['2025-01-02 00:00:00.000000', new DateTimeImmutable('2025-01-01 20:38:19.382290'), false],
        ];
    }

    #[Test]
    #[DataProvider('provideIsBeforeOrEqual')]
    public function isBeforeOrEqual(string $datetime, Date|DateImmutable|DateTimeInterface $other, bool $expected): void
    {
        $this->assertSame($expected, new Date($datetime)->isBeforeOrEqual($other));
    }

    public static function provideIsBeforeOrEqual(): array
    {
        return [
            ['2025-01-01', new Date('2025-01-01'), true],
            ['2025-01-01', new DateImmutable('2025-01-01'), true],
            ['2025-01-01', new DateTime('2025-01-01'), true],
            ['2025-01-01', new DateTimeImmutable('2025-01-01'), true],
            ['2025-01-01 20:38:19.382290', new Date('2025-01-01 20:38:19.382290'), true],
            ['2025-01-01 20:38:19.382290', new DateImmutable('2025-01-01 20:38:19.382290'), true],
            ['2025-01-01 20:38:19.382290', new DateTime('2025-01-01 20:38:19.382290'), true],
            ['2025-01-01 20:38:19.382290', new DateTimeImmutable('2025-01-01 20:38:19.382290'), true],
            ['2025-01-01 00:00:00.000000', new Date('2025-01-01 20:38:19.382290'), true],
            ['2025-01-01 00:00:00.000000', new DateImmutable('2025-01-01 20:38:19.382290'), true],
            ['2025-01-01 00:00:00.000000', new DateTime('2025-01-01 20:38:19.382290'), true],
            ['2025-01-01 00:00:00.000000', new DateTimeImmutable('2025-01-01 20:38:19.382290'), true],
            ['2025-01-01', new Date('2025-01-02'), true],
            ['2025-01-01', new DateImmutable('2025-01-02'), true],
            ['2025-01-01', new DateTime('2025-01-02'), true],
            ['2025-01-01', new DateTimeImmutable('2025-01-02'), true],
            ['2025-01-01 20:38:19.382290', new Date('2025-01-02 20:38:19.382290'), true],
            ['2025-01-01 20:38:19.382290', new DateImmutable('2025-01-02 20:38:19.382290'), true],
            ['2025-01-01 20:38:19.382290', new DateTime('2025-01-02 20:38:19.382290'), true],
            ['2025-01-01 20:38:19.382290', new DateTimeImmutable('2025-01-02 20:38:19.382290'), true],
            ['2025-01-01 00:00:00.000000', new Date('2025-01-02 20:38:19.382290'), true],
            ['2025-01-01 00:00:00.000000', new DateImmutable('2025-01-02 20:38:19.382290'), true],
            ['2025-01-01 00:00:00.000000', new DateTime('2025-01-02 20:38:19.382290'), true],
            ['2025-01-01 00:00:00.000000', new DateTimeImmutable('2025-01-02 20:38:19.382290'), true],
            ['2025-01-02', new Date('2025-01-01'), false],
            ['2025-01-02', new DateImmutable('2025-01-01'), false],
            ['2025-01-02', new DateTime('2025-01-01'), false],
            ['2025-01-02', new DateTimeImmutable('2025-01-01'), false],
            ['2025-01-02 20:38:19.382290', new Date('2025-01-01 20:38:19.382290'), false],
            ['2025-01-02 20:38:19.382290', new DateImmutable('2025-01-01 20:38:19.382290'), false],
            ['2025-01-02 20:38:19.382290', new DateTime('2025-01-01 20:38:19.382290'), false],
            ['2025-01-02 20:38:19.382290', new DateTimeImmutable('2025-01-01 20:38:19.382290'), false],
            ['2025-01-02 00:00:00.000000', new Date('2025-01-01 20:38:19.382290'), false],
            ['2025-01-02 00:00:00.000000', new DateImmutable('2025-01-01 20:38:19.382290'), false],
            ['2025-01-02 00:00:00.000000', new DateTime('2025-01-01 20:38:19.382290'), false],
            ['2025-01-02 00:00:00.000000', new DateTimeImmutable('2025-01-01 20:38:19.382290'), false],
        ];
    }

    #[Test]
    #[DataProvider('provideIsAfter')]
    public function isAfter(string $datetime, Date|DateImmutable|DateTimeInterface $other, bool $expected): void
    {
        $this->assertSame($expected, new Date($datetime)->isAfter($other));
    }

    public static function provideIsAfter(): array
    {
        return [
            ['2025-01-01', new Date('2025-01-01'), false],
            ['2025-01-01', new DateImmutable('2025-01-01'), false],
            ['2025-01-01', new DateTime('2025-01-01'), false],
            ['2025-01-01', new DateTimeImmutable('2025-01-01'), false],
            ['2025-01-01 20:38:19.382290', new Date('2025-01-01 20:38:19.382290'), false],
            ['2025-01-01 20:38:19.382290', new DateImmutable('2025-01-01 20:38:19.382290'), false],
            ['2025-01-01 20:38:19.382290', new DateTime('2025-01-01 20:38:19.382290'), false],
            ['2025-01-01 20:38:19.382290', new DateTimeImmutable('2025-01-01 20:38:19.382290'), false],
            ['2025-01-01 00:00:00.000000', new Date('2025-01-01 20:38:19.382290'), false],
            ['2025-01-01 00:00:00.000000', new DateImmutable('2025-01-01 20:38:19.382290'), false],
            ['2025-01-01 00:00:00.000000', new DateTime('2025-01-01 20:38:19.382290'), false],
            ['2025-01-01 00:00:00.000000', new DateTimeImmutable('2025-01-01 20:38:19.382290'), false],
            ['2025-01-01', new Date('2025-01-02'), false],
            ['2025-01-01', new DateImmutable('2025-01-02'), false],
            ['2025-01-01', new DateTime('2025-01-02'), false],
            ['2025-01-01', new DateTimeImmutable('2025-01-02'), false],
            ['2025-01-01 20:38:19.382290', new Date('2025-01-02 20:38:19.382290'), false],
            ['2025-01-01 20:38:19.382290', new DateImmutable('2025-01-02 20:38:19.382290'), false],
            ['2025-01-01 20:38:19.382290', new DateTime('2025-01-02 20:38:19.382290'), false],
            ['2025-01-01 20:38:19.382290', new DateTimeImmutable('2025-01-02 20:38:19.382290'), false],
            ['2025-01-01 00:00:00.000000', new Date('2025-01-02 20:38:19.382290'), false],
            ['2025-01-01 00:00:00.000000', new DateImmutable('2025-01-02 20:38:19.382290'), false],
            ['2025-01-01 00:00:00.000000', new DateTime('2025-01-02 20:38:19.382290'), false],
            ['2025-01-01 00:00:00.000000', new DateTimeImmutable('2025-01-02 20:38:19.382290'), false],
            ['2025-01-02', new Date('2025-01-01'), true],
            ['2025-01-02', new DateImmutable('2025-01-01'), true],
            ['2025-01-02', new DateTime('2025-01-01'), true],
            ['2025-01-02', new DateTimeImmutable('2025-01-01'), true],
            ['2025-01-02 20:38:19.382290', new Date('2025-01-01 20:38:19.382290'), true],
            ['2025-01-02 20:38:19.382290', new DateImmutable('2025-01-01 20:38:19.382290'), true],
            ['2025-01-02 20:38:19.382290', new DateTime('2025-01-01 20:38:19.382290'), true],
            ['2025-01-02 20:38:19.382290', new DateTimeImmutable('2025-01-01 20:38:19.382290'), true],
            ['2025-01-02 00:00:00.000000', new Date('2025-01-01 20:38:19.382290'), true],
            ['2025-01-02 00:00:00.000000', new DateImmutable('2025-01-01 20:38:19.382290'), true],
            ['2025-01-02 00:00:00.000000', new DateTime('2025-01-01 20:38:19.382290'), true],
            ['2025-01-02 00:00:00.000000', new DateTimeImmutable('2025-01-01 20:38:19.382290'), true],
        ];
    }

    #[Test]
    #[DataProvider('provideIsAfterOrEqual')]
    public function isAfterOrEqual(string $datetime, Date|DateImmutable|DateTimeInterface $other, bool $expected): void
    {
        $this->assertSame($expected, new Date($datetime)->isAfterOrEqual($other));
    }

    public static function provideIsAfterOrEqual(): array
    {
        return [
            ['2025-01-01', new Date('2025-01-01'), true],
            ['2025-01-01', new DateImmutable('2025-01-01'), true],
            ['2025-01-01', new DateTime('2025-01-01'), true],
            ['2025-01-01', new DateTimeImmutable('2025-01-01'), true],
            ['2025-01-01 20:38:19.382290', new Date('2025-01-01 20:38:19.382290'), true],
            ['2025-01-01 20:38:19.382290', new DateImmutable('2025-01-01 20:38:19.382290'), true],
            ['2025-01-01 20:38:19.382290', new DateTime('2025-01-01 20:38:19.382290'), true],
            ['2025-01-01 20:38:19.382290', new DateTimeImmutable('2025-01-01 20:38:19.382290'), true],
            ['2025-01-01 00:00:00.000000', new Date('2025-01-01 20:38:19.382290'), true],
            ['2025-01-01 00:00:00.000000', new DateImmutable('2025-01-01 20:38:19.382290'), true],
            ['2025-01-01 00:00:00.000000', new DateTime('2025-01-01 20:38:19.382290'), true],
            ['2025-01-01 00:00:00.000000', new DateTimeImmutable('2025-01-01 20:38:19.382290'), true],
            ['2025-01-01', new Date('2025-01-02'), false],
            ['2025-01-01', new DateImmutable('2025-01-02'), false],
            ['2025-01-01', new DateTime('2025-01-02'), false],
            ['2025-01-01', new DateTimeImmutable('2025-01-02'), false],
            ['2025-01-01 20:38:19.382290', new Date('2025-01-02 20:38:19.382290'), false],
            ['2025-01-01 20:38:19.382290', new DateImmutable('2025-01-02 20:38:19.382290'), false],
            ['2025-01-01 20:38:19.382290', new DateTime('2025-01-02 20:38:19.382290'), false],
            ['2025-01-01 20:38:19.382290', new DateTimeImmutable('2025-01-02 20:38:19.382290'), false],
            ['2025-01-01 00:00:00.000000', new Date('2025-01-02 20:38:19.382290'), false],
            ['2025-01-01 00:00:00.000000', new DateImmutable('2025-01-02 20:38:19.382290'), false],
            ['2025-01-01 00:00:00.000000', new DateTime('2025-01-02 20:38:19.382290'), false],
            ['2025-01-01 00:00:00.000000', new DateTimeImmutable('2025-01-02 20:38:19.382290'), false],
            ['2025-01-02', new Date('2025-01-01'), true],
            ['2025-01-02', new DateImmutable('2025-01-01'), true],
            ['2025-01-02', new DateTime('2025-01-01'), true],
            ['2025-01-02', new DateTimeImmutable('2025-01-01'), true],
            ['2025-01-02 20:38:19.382290', new Date('2025-01-01 20:38:19.382290'), true],
            ['2025-01-02 20:38:19.382290', new DateImmutable('2025-01-01 20:38:19.382290'), true],
            ['2025-01-02 20:38:19.382290', new DateTime('2025-01-01 20:38:19.382290'), true],
            ['2025-01-02 20:38:19.382290', new DateTimeImmutable('2025-01-01 20:38:19.382290'), true],
            ['2025-01-02 00:00:00.000000', new Date('2025-01-01 20:38:19.382290'), true],
            ['2025-01-02 00:00:00.000000', new DateImmutable('2025-01-01 20:38:19.382290'), true],
            ['2025-01-02 00:00:00.000000', new DateTime('2025-01-01 20:38:19.382290'), true],
            ['2025-01-02 00:00:00.000000', new DateTimeImmutable('2025-01-01 20:38:19.382290'), true],
        ];
    }

    #[Test]
    #[DataProvider('provideFormat')]
    public function format(string $datetime, string $format, string $expected): void
    {
        $this->assertSame($expected, new Date($datetime)->format($format));
    }

    public static function provideFormat(): array
    {
        return [
            ['2025-01-01', 'Y-m-d', '2025-01-01'],
            ['2025-01-01', 'Y/m/d', '2025/01/01'],
            ['2025-01-01', 'Y-m-d H:i:s', '2025-01-01 00:00:00'],
            ['2025-01-01', 'Y-m-d H:i:s.u', '2025-01-01 00:00:00.000000'],
        ];
    }

    #[Test]
    #[DataProvider('provideGetTimezone')]
    public function getTimezone(string $datetime, ?DateTimeZone $timezone, DateTimeZone $expected): void
    {
        $this->assertSame($expected->getName(), new Date($datetime, $timezone)->getTimezone()->getName());
    }

    public static function provideGetTimezone(): array
    {
        return [
            ['2025-01-01', new DateTimeZone('UTC'), new DateTimeZone('UTC')],
            ['2025-01-31T10:20:29+09:00', null, new DateTimeZone('+09:00')],
        ];
    }

    #[Test]
    #[DataProvider('provideSetTimezone')]
    public function setTimezone(string $datetime, ?DateTimeZone $timezone, DateTimeZone $modifiedTimezone, DateTimeZone $expected): void
    {
        $this->assertSame($expected->getName(), new Date($datetime, $timezone)->setTimezone($modifiedTimezone)->getTimezone()->getName());
    }

    public static function provideSetTimezone(): array
    {
        return [
            ['2025-01-01', null, new DateTimeZone('UTC'), new DateTimeZone('UTC')],
            ['2025-01-31T10:20:29+09:00', null, new DateTimeZone('UTC'), new DateTimeZone('UTC')],
        ];
    }

    #[Test]
    public function toImmutable(): void
    {
        $this->assertInstanceOf(DateImmutable::class, new Date()->toImmutable());
    }
}
