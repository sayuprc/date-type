<?php

declare(strict_types=1);

namespace Tests\DateType\MutableDate;

use DateTimeZone;
use DateType\MutableDate;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SetTimezoneTest extends TestCase
{
    #[Test]
    public function setTimezone(): void
    {
        $date = new MutableDate('2025-01-01 20:38:19.382290');

        $newDate = $date->setTimezone(new DateTimeZone('Asia/Tokyo'));

        $this->assertSame('2025-01-01 00:00:00.000000', $newDate->format(self::DEFAULT_FORMAT));
        $this->assertSame($date, $newDate);
        $this->assertNotSame($date->getTimezone(), $newDate->getTimezone());
    }
}
