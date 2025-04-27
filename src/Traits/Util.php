<?php

declare(strict_types=1);

namespace DateType\Traits;

use DateInterval;

trait Util
{
    /**
     * @return array{0: DateInterval, 1: DateInterval, 2: DateInterval}
     */
    private function splitIntervalComponents(DateInterval $interval): array
    {
        $string = explode(' ', $interval->format('%R%yyear %R%mmonth %R%dday'), 3);

        return [
            DateInterval::createFromDateString($string[0]),
            DateInterval::createFromDateString($string[1]),
            DateInterval::createFromDateString($string[2]),
        ];
    }
}
