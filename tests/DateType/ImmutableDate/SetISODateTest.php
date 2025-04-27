<?php

declare(strict_types=1);

namespace Tests\DateType\ImmutableDate;

use DateType\ImmutableDate;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SetISODateTest extends TestCase
{
    #[Test]
    public function setDate(): void
    {
        $date = new ImmutableDate('2025-01-01 20:38:19.382290');

        $newDate = $date->setISODate(2026, 1, 4);

        $this->assertSame('2026-01-01 00:00:00.000000', $newDate->format(self::DEFAULT_FORMAT));
        $this->assertNotSame($newDate, $date);
        $this->assertNotSame($date->format(self::DEFAULT_FORMAT), $newDate->format(self::DEFAULT_FORMAT));
    }
}
