<?php

declare(strict_types=1);

namespace Tests\DateType\MutableDate;

use DateTime;
use DateType\MutableDate;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SetTestNow extends TestCase
{
    #[Test]
    public function nowUsesFixedDate(): void
    {
        MutableDate::setTestNow(new DateTime('2025-01-01 20:38:19.382290'));

        $now = new MutableDate();

        $this->assertSame('2025-01-01 00:00:00.000000', $now->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function notUsesFixedDate(): void
    {
        MutableDate::setTestNow(new DateTime('2025-01-01 20:38:19.382290'));

        $now = new MutableDate('2025-01-02');

        $this->assertSame('2025-01-02 00:00:00.000000', $now->format(self::DEFAULT_FORMAT));
    }
}
