<?php

declare(strict_types=1);

namespace DateType;

use DateTime;

class Date
{
    public function __construct(public private(set) DateTime $value)
    {
        $this->value = new DateTime($this->value->format('Y-m-d 00:00:00.000000'));
    }
}
