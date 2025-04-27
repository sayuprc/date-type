<?php

declare(strict_types=1);

namespace Tests\DateType\ImmutableDate;

use DateType\ImmutableDate;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SetTimestampTest extends TestCase
{
    #[Test]
    public function setTimestamp(): void
    {
        $date = new ImmutableDate('2025-01-01 20:38:19.382290');

        $newDate = $date->setTimestamp(1745792563);

        $this->assertSame('2025-04-27 00:00:00.000000', $newDate->format(self::DEFAULT_FORMAT));
        $this->assertNotSame($date, $newDate);
        $this->assertNotSame($date->format(self::DEFAULT_FORMAT), $newDate->format(self::DEFAULT_FORMAT));
    }
}
