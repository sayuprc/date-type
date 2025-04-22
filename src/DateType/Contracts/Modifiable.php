<?php

declare(strict_types=1);

namespace DateType\Contracts;

interface Modifiable
{
    public function addYears(int $year = 1): Modifiable;

    public function addMonths(int $month = 1): Modifiable;

    public function addDays(int $day = 1): Modifiable;

    public function subYears(int $year = 1): Modifiable;

    public function subMonths(int $month = 1): Modifiable;

    public function subDays(int $day = 1): Modifiable;
}
