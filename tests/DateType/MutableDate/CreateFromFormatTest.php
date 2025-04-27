<?php

declare(strict_types=1);

namespace Tests\DateType\MutableDate;

use DateType\MutableDate;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CreateFromFormatTest extends TestCase
{
    #[Test]
    public function createFromFormat(): void
    {
        $date = MutableDate::createFromFormat('Y-m-d H:i:s.u', '2025-01-01 00:00:00.000000');

        $this->assertInstanceOf(MutableDate::class, $date);
        $this->assertSame('2025-01-01 00:00:00.000000', $date->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function invalidFormat(): void
    {
        $date = MutableDate::createFromFormat('Y-m-d', '2025-01-01 00:00:00.000000');

        $this->assertFalse($date);
    }
}
