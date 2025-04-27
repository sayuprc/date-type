<?php

declare(strict_types=1);

namespace Tests\DateType\ImmutableDate;

use DateTime;
use DateType\ImmutableDate;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SetTestNowTest extends TestCase
{
    #[Test]
    public function nowUsesFixedDate(): void
    {
        ImmutableDate::setTestNow(new DateTime('2025-01-01 20:38:19.382290'));

        $now = new ImmutableDate();

        $this->assertSame('2025-01-01 00:00:00.000000', $now->format(self::DEFAULT_FORMAT));
    }

    #[Test]
    public function notUsesFixedDate(): void
    {
        ImmutableDate::setTestNow(new DateTime('2025-01-01 20:38:19.382290'));

        $now = new ImmutableDate('2025-01-02');

        $this->assertSame('2025-01-02 00:00:00.000000', $now->format(self::DEFAULT_FORMAT));
    }
}
