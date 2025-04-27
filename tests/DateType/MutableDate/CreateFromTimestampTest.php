<?php

declare(strict_types=1);

namespace Tests\DateType\MutableDate;

use DateType\MutableDate;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CreateFromTimestampTest extends TestCase
{
    #[Test]
    public function createFromTimestamp(): void
    {
        $date = MutableDate::createFromTimestamp(1735689600);

        $this->assertInstanceOf(MutableDate::class, $date);
        $this->assertSame('2025-01-01 00:00:00.000000', $date->format(self::DEFAULT_FORMAT));
    }
}
