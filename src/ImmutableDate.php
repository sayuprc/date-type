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

class ImmutableDate extends DateTimeImmutable implements DateInterface
{
    use Comparable;
    use Delegate;
    use Diff;
    use Factory;
    use Testing;
    use Util;

    /**
     * @throws DateMalformedStringException
     */
    public function __construct(string $datetime = 'now', ?DateTimeZone $timezone = null)
    {
        $datetime = $datetime === 'now' && ! is_null(self::$testNow)
            ? self::$testNow
            : new DateTimeImmutable($datetime, $timezone)->setTime(0, 0);
        $timezone = $datetime->getTimezone() ?: null;

        parent::__construct($datetime->format('Y-m-d H:i:s.u'), $timezone);
    }

    #[Override]
    public static function createFromMutable(DateTime $object): static
    {
        return self::create(parent::createFromMutable($object));
    }

    /**
     * Adds the given DateInterval, preventing month/year overflows, and returns a new ImmutableDate instance.
     *
     * This method adds the year, month, and other components (days, etc.) of the interval separately
     * to a base DateTimeImmutable representing the current date. It ensures that adding years or
     * months does not cause unexpected day changes (e.g., Jan 31 + 1 month = Feb 28/29).
     * The time components (H, I, S, F) of the interval are effectively ignored.
     * The resulting time is always 00:00:00 in the new instance.
     */
    #[Override]
    public function add(DateInterval $interval): ImmutableDate
    {
        [$yearInterval, $monthInterval, $dayInterval] = $this->splitIntervalComponents($interval);

        $base = new DateTimeImmutable($this->format('Y-m-d H:i:s.u'), $this->getTimezone() ?: null);

        if ($interval->y !== 0) {
            $base = $this->addInterval($base, $yearInterval);
        }

        if ($interval->m !== 0) {
            $base = $this->addInterval($base, $monthInterval);
        }

        return self::create($base->add($dayInterval));
    }

    private function addInterval(DateTimeImmutable $date, DateInterval $interval): DateTimeImmutable
    {
        $before = clone $date;

        $date = $date->add($interval);

        return $date->format('d') !== $before->format('d')
            ? $date->modify('last day of previous month')
            : $date;
    }

    /**
     * Subtracts the given DateInterval, preventing month/year overflows, and returns a new ImmutableDate instance.
     *
     * This method subtracts the year, month, and other components (days, etc.) of the interval separately
     * from a base DateTimeImmutable representing the current date. It ensures that subtracting years or
     * months does not cause unexpected day changes (e.g., Mar 31 - 1 month = Feb 28/29).
     * The time components (H, I, S, F) of the interval are effectively ignored.
     * The resulting time is always 00:00:00 in the new instance.
     */
    #[Override]
    public function sub(DateInterval $interval): ImmutableDate
    {
        [$yearInterval, $monthInterval, $otherInterval] = $this->splitIntervalComponents($interval);

        $base = new DateTimeImmutable($this->format('Y-m-d H:i:s.u'), $this->getTimezone() ?: null);

        if ($interval->y !== 0) {
            $base = $this->subInterval($base, $yearInterval);
        }

        if ($interval->m !== 0) {
            $base = $this->subInterval($base, $monthInterval);
        }

        return self::create($base->sub($otherInterval));
    }

    private function subInterval(DateTimeImmutable $date, DateInterval $interval): DateTimeImmutable
    {
        $before = clone $date;

        $date = $date->sub($interval);

        return $date->format('d') !== $before->format('d')
            ? $date->modify('last day of previous month')
            : $date;
    }

    /**
     * Alters the timestamp based on the modifier string and returns a new ImmutableDate instance.
     *
     * The modification is applied to the parent DateTimeImmutable, and then a new
     * ImmutableDate is created from the result. The `self::create` factory method
     * ensures the time component of the new instance is reset to 00:00:00.
     *
     * @throws DateMalformedStringException
     */
    #[Override]
    public function modify(string $modifier): ImmutableDate
    {
        return self::create(parent::modify($modifier));
    }

    #[Override]
    public function setDate(int $year, int $month, int $day): ImmutableDate
    {
        return self::create(parent::setDate($year, $month, $day));
    }

    #[Override]
    public function setISODate(int $year, int $week, int $dayOfWeek = 1): ImmutableDate
    {
        return self::create(parent::setISODate($year, $week, $dayOfWeek));
    }

    /**
     * Sets the time to midnight (00:00:00.000000) and returns a new ImmutableDate instance.
     *
     * Ignores any provided arguments and always sets the time to midnight.
     * This effectively returns a new instance representing the same date but ensures
     * the time is exactly midnight, consistent with the class's purpose.
     */
    #[Override]
    public function setTime(int $hour, int $minute, int $second = 0, int $microsecond = 0): ImmutableDate
    {
        return self::create($this);
    }

    /**
     * Sets the microsecond component to 0 and returns a new ImmutableDate instance.
     *
     * Ignores the provided argument, ensuring the time component remains precisely
     * at the start of the second (0 microseconds) in the new instance.
     */
    #[Override]
    public function setMicrosecond(int $microsecond): static
    {
        return self::create($this);
    }

    /**
     * Sets the date based on a Unix timestamp and returns a new ImmutableDate instance.
     *
     * Creates a new instance with the date determined by the timestamp.
     * The time component in the new instance is reset to 00:00:00 via `self::create`.
     *
     * @param int $timestamp The Unix timestamp representing a point in time.
     *
     * @return static A new ImmutableDate instance with the date from the timestamp and time reset to midnight.
     */
    #[Override]
    public function setTimestamp(int $timestamp): ImmutableDate
    {
        return self::create(parent::setTimestamp($timestamp));
    }

    /**
     * Sets the timezone and returns a new ImmutableDate instance.
     *
     * Creates a new instance with the specified timezone applied. The date might change
     * if the original time was near midnight. The time component in the new instance
     * is reset to 00:00:00 via `self::create`.
     */
    #[Override]
    public function setTimezone(DateTimeZone $timezone): ImmutableDate
    {
        return self::create(parent::setTimezone($timezone));
    }

    /**
     * Adds the specified number of years safely and returns a new ImmutableDate instance.
     *
     * Prevents month/day overflows (e.g., Feb 29 + 1 year = Feb 28).
     * The time in the new instance remains at midnight.
     */
    public function addYears(int $year = 1): static
    {
        return self::create($this->addModify($year, Unit::Year));
    }

    /**
     * Adds the specified number of months safely and returns a new ImmutableDate instance.
     *
     * Prevents month/day overflows (e.g., Jan 31 + 1 month = Feb 28/29).
     * The time in the new instance remains at midnight.
     */
    public function addMonths(int $month = 1): static
    {
        return  self::create($this->addModify($month, Unit::Month));
    }

    public function addDays(int $day = 1): static
    {
        return self::create($this->addModify($day, Unit::Day));
    }

    /**
     * Subtracts the specified number of years safely and returns a new ImmutableDate instance.
     *
     * Prevents month/day overflows (e.g., Feb 29 - 1 year = Feb 28).
     * The time in the new instance remains at midnight.
     */
    public function subYears(int $year = 1): static
    {
        return self::create($this->subModify($year, Unit::Year));
    }

    /**
     * Subtracts the specified number of months safely and returns a new ImmutableDate instance.
     *
     * Prevents month/day overflows (e.g., Mar 31 - 1 month = Feb 28/29).
     * The time in the new instance remains at midnight.
     */
    public function subMonths(int $month = 1): static
    {
        return self::create($this->subModify($month, Unit::Month));
    }

    public function subDays(int $day = 1): static
    {
        return self::create($this->subModify($day, Unit::Day));
    }

    private function addModify(int $value, Unit $unit): ImmutableDate
    {
        return $this->modifyUnit(Operator::Add, $value, $unit);
    }

    private function subModify(int $value, Unit $unit): ImmutableDate
    {
        return $this->modifyUnit(Operator::Sub, $value, $unit);
    }

    private function modifyUnit(Operator $operator, int $value, Unit $unit): ImmutableDate
    {
        $modifiedDate = $this->modify($operator->value . $value . $unit->value);

        return $unit->isOverflowable() && $modifiedDate->format('d') !== $this->format('d')
            ? $modifiedDate->modify('last day of previous month')
            : $modifiedDate;
    }

    public function toMutable(): MutableDate
    {
        return new MutableDate($this->format('Y-m-d H:i:s.u'), $this->getTimezone() ?: null);
    }
}
