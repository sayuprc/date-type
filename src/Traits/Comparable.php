<?php

declare(strict_types=1);

namespace DateType\Traits;

use DateTimeInterface;

/**
 * Provides methods for comparing DateInterface objects based solely on their date part (Y-m-d).
 * Time components are ignored in all comparisons.
 * The comparison target is normalized using `self::create()` before comparison.
 */
trait Comparable
{
    public function isEqual(DateTimeInterface $other): bool
    {
        return $this->format('Y-m-d') === self::create($other)->format('Y-m-d');
    }

    public function isBefore(DateTimeInterface $other): bool
    {
        return $this->format('Y-m-d') < self::create($other)->format('Y-m-d');
    }

    public function isBeforeOrEqual(DateTimeInterface $other): bool
    {
        return $this->format('Y-m-d') <= self::create($other)->format('Y-m-d');
    }

    public function isAfter(DateTimeInterface $other): bool
    {
        return self::create($other)->format('Y-m-d') < $this->format('Y-m-d');
    }

    public function isAfterOrEqual(DateTimeInterface $other): bool
    {
        return self::create($other)->format('Y-m-d') <= $this->format('Y-m-d');
    }
}
