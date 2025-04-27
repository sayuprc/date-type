<?php

declare(strict_types=1);

namespace Tests\DateType\ImmutableDate;

use DateType\ImmutableDate;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CreateFromTimestampTest extends TestCase
{
    #[Test]
    public function createFromTimestamp(): void
    {
        $date = ImmutableDate::createFromTimestamp(1735689600);

        $this->assertInstanceOf(ImmutableDate::class, $date);
        $this->assertSame('2025-01-01 00:00:00.000000', $date->format(self::DEFAULT_FORMAT));
    }
}
