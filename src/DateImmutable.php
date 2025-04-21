<?php

declare(strict_types=1);

namespace DateType;

use DateTimeImmutable;

class DateImmutable
{
    public function __construct(public private(set) DateTimeImmutable $value)
    {
        $this->value = new DateTimeImmutable($this->value->format('Y-m-d 00:00:00.000000'));
    }
}
