<?php

declare(strict_types=1);

namespace DateType\Contracts;

use DateTimeInterface;

interface Comparable
{
    public function isSame(DateTimeInterface $other): bool;

    public function isBefore(DateTimeInterface $other): bool;

    public function isBeforeOrEqual(DateTimeInterface $other): bool;

    public function isAfter(DateTimeInterface $other): bool;

    public function isAfterOrEqual(DateTimeInterface $other): bool;
}
