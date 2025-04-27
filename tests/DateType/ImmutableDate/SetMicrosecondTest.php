<?php

declare(strict_types=1);

namespace Tests\DateType\ImmutableDate;

use DateType\ImmutableDate;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SetMicrosecondTest extends TestCase
{
    #[Test]
    public function setMicrosecond(): void
    {
        $date = new ImmutableDate('2025-01-01 10:30:45.080607');

        $newDate = $date->setMicrosecond(123456);

        $this->assertSame('2025-01-01 00:00:00.000000', $newDate->format(self::DEFAULT_FORMAT));
        $this->assertNotSame($date, $newDate);
    }
}
