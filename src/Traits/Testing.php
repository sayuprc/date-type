<?php

declare(strict_types=1);

namespace DateType\Traits;

use DateTimeInterface;
use DateType\ImmutableDate;

trait Testing
{
    private static ?ImmutableDate $testNow = null;

    public static function setTestNow(DateTimeInterface|string $datetime): void
    {
        if (is_string($datetime)) {
            $datetime = new ImmutableDate($datetime);
        }

        self::$testNow = ImmutableDate::createFromInterface($datetime);
    }
}
