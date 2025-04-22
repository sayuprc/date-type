<?php

declare(strict_types=1);

namespace DateType;

enum Unit: string
{
    case Year = 'year';
    case Month = 'month';
    case Day = 'day';

    public function isOverflow(): bool
    {
        return in_array(
            $this,
            [
                self::Year,
                self::Month,
            ],
            true
        );
    }
}
