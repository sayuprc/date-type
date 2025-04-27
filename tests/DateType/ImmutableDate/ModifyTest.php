<?php

declare(strict_types=1);

namespace Tests\DateType\ImmutableDate;

use DateType\ImmutableDate;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ModifyTest extends TestCase
{
    #[Test]
    public function modify(): void
    {
        $date = new ImmutableDate('2025-01-01 20:38:19.382290');

        $modified = $date->modify('1year 1month 1day 1hour 1minute 1second');

        $this->assertSame('2026-02-02 00:00:00.000000', $modified->format(self::DEFAULT_FORMAT));
        $this->assertNotSame($date, $modified);
        $this->assertNotSame($date->format(self::DEFAULT_FORMAT), $modified->format(self::DEFAULT_FORMAT));
    }
}
