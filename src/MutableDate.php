<?php

declare(strict_types=1);

namespace DateType;

use DateInterval;
use DateMalformedStringException;
use DateTime;
use DateTimeImmutable;
use DateTimeZone;
use DateType\Traits\Comparable;
use DateType\Traits\Delegate;
use DateType\Traits\Diff;
use DateType\Traits\Factory;
use DateType\Traits\Testing;
use DateType\Traits\Util;
use Override;

class MutableDate extends DateTime implements DateInterface
{
    use Comparable;
    use Delegate;
    use Diff;
    use Factory;
    use Testing;
    use Util;

    public function __construct(string $datetime = 'now', ?DateTimeZone $timezone = null)
    {
        if ($datetime === 'now' && ! is_null(self::$testNow)) {
            $datetime = self::$testNow->format('Y-m-d H:i:s.u');
            $timezone = self::$testNow->getTimezone() ?: null;
        }

        parent::__construct($datetime, $timezone);

        $this->setTime(0, 0);
    }

    #[Override]
    public static function createFromImmutable(DateTimeImmutable $object): static
    {
        return self::create(parent::createFromImmutable($object));
    }

    /**
     * Adds the given DateInterval, preventing month/year overflows for year and month components.
     * This method adds the year, month, and other components (days, etc.) of the interval separately.
     * It ensures that adding years or months does not cause unexpected day changes (e.g., Jan 31 + 1 month = Feb 28/29).
     * The time components (H, I, S, F) of the interval are effectively ignored,
     * and the resulting time is always reset to 00:00:00.
     */
    #[Override]
    public function add(DateInterval $interval): MutableDate
    {
        [$yearInterval, $monthInterval, $otherInterval] = $this->splitIntervalComponents($interval);

        if ($interval->y !== 0) {
            $this->addInterval($yearInterval);
        }

        if ($interval->m !== 0) {
            $this->addInterval($monthInterval);
        }

        parent::add($otherInterval)->setTime(0, 0);

        return $this;
    }

    private function addInterval(DateInterval $interval): void
    {
        $before = clone $this;

        parent::add($interval);

        if ($this->format('d') !== $before->format('d')) {
            parent::modify('last day of previous month');
        }
    }

    /**
     * Subtracts the given DateInterval, preventing month/year overflows for year and month components.
     *
     * This method subtracts the year, month, and other components (days, etc.) of the interval separately.
     * It ensures that subtracting years or months does not cause unexpected day changes (e.g., Mar 31 - 1 month = Feb 28/29).
     * The time components (H, I, S, F) of the interval are effectively ignored,
     * and the resulting time is always reset to 00:00:00.
     */
    #[Override]
    public function sub(DateInterval $interval): MutableDate
    {
        [$yearInterval, $monthInterval, $dayInterval] = $this->splitIntervalComponents($interval);

        if ($interval->y !== 0) {
            $this->subInterval($yearInterval);
        }

        if ($interval->m !== 0) {
            $this->subInterval($monthInterval);
        }

        parent::sub($dayInterval)->setTime(0, 0);

        return $this;
    }

    private function subInterval(DateInterval $interval): void
    {
        $before = clone $this;

        parent::sub($interval);

        if ($this->format('d') !== $before->format('d')) {
            parent::modify('last day of previous month');
        }
    }

    /**
     * Alters the timestamp based on the modifier string, then resets the time to midnight.
     *
     * While the modification string might affect the time component temporarily
     * (e.g., using "+1 day +1 hour"), the final time is always reset to 00:00:00.
     *
     * @throws DateMalformedStringException If the modifier string is invalid (rethrown from potential parent exception).
     */
    #[Override]
    public function modify(string $modifier): static
    {
        parent::modify($modifier);

        return $this->setTime(0, 0);
    }

    #[Override]
    public function setDate(int $year, int $month, int $day): MutableDate
    {
        parent::setDate($year, $month, $day);

        return $this;
    }

    #[Override]
    public function setISODate(int $year, int $week, int $dayOfWeek = 1): MutableDate
    {
        parent::setISODate($year, $week, $dayOfWeek);

        return $this;
    }

    /**
     * Sets the time to midnight (00:00:00.000000), ignoring any provided arguments.
     *
     * This method enforces the class invariant that the object represents only a date.
     * Any hour, minute, second, or microsecond values passed are disregarded.
     */
    #[Override]
    public function setTime(int $hour, int $minute, int $second = 0, int $microsecond = 0): MutableDate
    {
        parent::setTime(0, 0);

        return $this;
    }

    /**
     * Sets the microsecond component to 0, ignoring the provided argument.
     *
     * This ensures the time component remains precisely at the start of the second (0 microseconds),
     * consistent with representing only a date.
     */
    #[Override]
    public function setMicrosecond(int $microsecond): static
    {
        parent::setMicrosecond(0);

        return $this;
    }

    /**
     * Sets the date based on a Unix timestamp, then resets the time to midnight.
     *
     * The date is determined by the timestamp, and then the time component
     * (hours, minutes, seconds, microseconds) is explicitly set to zero.
     */
    #[Override]
    public function setTimestamp(int $timestamp): MutableDate
    {
        parent::setTimestamp($timestamp)->setTime(0, 0);

        return $this;
    }

    /**
     * Sets the timezone for the date object, then resets the time to midnight in the new timezone.
     *
     * Changing the timezone might alter the date if the original time was close to midnight.
     * This method ensures the time component is reset to 00:00:00 *after* the timezone change
     * is applied.
     */
    #[Override]
    public function setTimezone(DateTimeZone $timezone): MutableDate
    {
        parent::setTimezone($timezone)->setTime(0, 0);

        return $this;
    }

    /**
     * Adds the specified number of years safely, preventing month/day overflows.
     *
     * For example, adding 1 year to Feb 29th on a leap year will result in Feb 28th
     * of the following year. The time remains at midnight.
     */
    public function addYears(int $year = 1): static
    {
        $this->addModify($year, Unit::Year);

        return $this;
    }

    /**
     * Adds the specified number of months safely, preventing month/day overflows.
     *
     * For example, adding 1 month to Jan 31st will result in Feb 28th (or 29th on leap year).
     * The time remains at midnight.
     */
    public function addMonths(int $month = 1): static
    {
        $this->addModify($month, Unit::Month);

        return $this;
    }

    public function addDays(int $day = 1): static
    {
        $this->addModify($day, Unit::Day);

        return $this;
    }

    /**
     * Subtracts the specified number of years safely, preventing month/day overflows.
     *
     * For example, subtracting 1 year from Feb 29th on a leap year will result in Feb 28th
     * of the previous year. The time remains at midnight.
     */
    public function subYears(int $year = 1): static
    {
        $this->subModify($year, Unit::Year);

        return $this;
    }

    /**
     * Subtracts the specified number of months safely, preventing month/day overflows.
     *
     * For example, subtracting 1 month from Mar 31st will result in Feb 28th (or 29th on leap year).
     * The time remains at midnight.
     */
    public function subMonths(int $month = 1): static
    {
        $this->subModify($month, Unit::Month);

        return $this;
    }

    public function subDays(int $day = 1): static
    {
        $this->subModify($day, Unit::Day);

        return $this;
    }

    private function addModify(int $value, Unit $unit): static
    {
        return $this->modifyUnit(Operator::Add, $value, $unit);
    }

    private function subModify(int $value, Unit $unit): static
    {
        return $this->modifyUnit(Operator::Sub, $value, $unit);
    }

    private function modifyUnit(Operator $operator, int $value, Unit $unit): static
    {
        $before = clone $this;

        $modifiedDate = $this->modify($operator->value . $value . $unit->value);

        return $unit->isOverflowable() && $modifiedDate->format('d') !== $before->format('d')
            ? $modifiedDate->modify('last day of previous month')
            : $modifiedDate;
    }

    public function toImmutable(): ImmutableDate
    {
        return new ImmutableDate($this->format('Y-m-d H:i:s.u'), $this->getTimezone() ?: null);
    }
}
