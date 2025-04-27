<?php

declare(strict_types=1);

namespace DateType;

use DateTimeInterface;

interface DateInterface extends DateTimeInterface
{
    public function addYears(int $year = 1): static;

    public function addMonths(int $month = 1): static;

    public function addDays(int $day = 1): static;

    public function subYears(int $year = 1): static;

    public function subMonths(int $month = 1): static;

    public function subDays(int $day = 1): static;

    public function isEqual(DateTimeInterface $other): bool;

    public function isBefore(DateTimeInterface $other): bool;

    public function isBeforeOrEqual(DateTimeInterface $other): bool;

    public function isAfter(DateTimeInterface $other): bool;

    public function isAfterOrEqual(DateTimeInterface $other): bool;
}
