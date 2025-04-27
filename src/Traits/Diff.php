<?php

declare(strict_types=1);

namespace DateType\Traits;

use DateInterval;
use DateTimeInterface;
use Override;

trait Diff
{
    /**
     * Calculates the difference between two date objects, normalizing the target object first.
     */
    #[Override]
    public function diff(DateTimeInterface $targetObject, bool $absolute = false): DateInterval
    {
        return parent::diff(self::create($targetObject), $absolute);
    }
}
