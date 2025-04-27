<?php

declare(strict_types=1);

namespace Tests\DateType\MutableDate;

use DateType\MutableDate;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SetISODateTest extends TestCase
{
    #[Test]
    public function setDate(): void
    {
        $date = new MutableDate('2025-01-01 20:38:19.382290');

        $newDate = $date->setISODate(2026, 1, 4);

        $this->assertSame('2026-01-01 00:00:00.000000', $newDate->format(self::DEFAULT_FORMAT));
        $this->assertSame($newDate, $date);
        $this->assertSame($date->format(self::DEFAULT_FORMAT), $newDate->format(self::DEFAULT_FORMAT));
    }
}
