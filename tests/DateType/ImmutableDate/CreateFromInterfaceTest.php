<?php

declare(strict_types=1);

namespace DateType\ImmutableDate;

use DateTime;
use DateTimeImmutable;
use DateType\ImmutableDate;
use DateType\MutableDate;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CreateFromInterfaceTest extends TestCase
{
    #[Test]
    public function createFromInterfaceWithDateTime(): void
    {
        $date = ImmutableDate::createFromInterface(new DateTime('2025-01-01 10:30:45.080607'));

        $this->assertInstanceOf(ImmutableDate::class, $date);
        $this->assertSame('2025-01-01 00:00:00.000000', $date->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function createFromInterfaceWithDateTimeImmutable(): void
    {
        $date = ImmutableDate::createFromInterface(new DateTimeImmutable('2025-01-01 10:30:45.080607'));

        $this->assertInstanceOf(ImmutableDate::class, $date);
        $this->assertSame('2025-01-01 00:00:00.000000', $date->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function createFromInterfaceWithMutableDate(): void
    {
        $date = ImmutableDate::createFromInterface(new MutableDate('2025-01-01 10:30:45.080607'));

        $this->assertInstanceOf(ImmutableDate::class, $date);
        $this->assertSame('2025-01-01 00:00:00.000000', $date->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function createFromInterfaceWithImmutableDate(): void
    {
        $date = ImmutableDate::createFromInterface(new ImmutableDate('2025-01-01 10:30:45.080607'));

        $this->assertInstanceOf(ImmutableDate::class, $date);
        $this->assertSame('2025-01-01 00:00:00.000000', $date->format(self::DEFAULT_FORMAT));
    }
}
