<?php

declare(strict_types=1);

namespace DateType;

use DateInterval;
use DateTime;
use DateTimeInterface;
use DateTimeZone;
use DateType\Contracts\Comparable;
use DateType\Contracts\Modifiable;

class Date implements Comparable, Modifiable
{
    private DateTime $date;

    public function __construct(Date|DateImmutable|DateTimeInterface|string $datetime = 'now', ?DateTimeZone $timezone = null)
    {
        $datetime = ! is_string($datetime) ? $datetime->format('Y-m-d H:i:s.u') : $datetime;

        $this->date = $this->setTimeZero(new DateTime($datetime, $timezone));
    }

    public function addYears(int $year = 1): self
    {
        $this->date = $this->addModify(abs($year), Unit::Year);

        return $this;
    }

    public function addMonths(int $month = 1): self
    {
        $this->date = $this->addModify(abs($month), Unit::Month);

        return $this;
    }

    public function addDays(int $day = 1): self
    {
        $this->date = $this->addModify(abs($day), Unit::Day);

        return $this;
    }

    public function subYears(int $year = 1): self
    {
        $this->date = $this->subModify(abs($year), Unit::Year);

        return $this;
    }

    public function subMonths(int $month = 1): self
    {
        $this->date = $this->subModify(abs($month), Unit::Month);

        return $this;
    }

    public function subDays(int $day = 1): self
    {
        $this->date = $this->subModify(abs($day), Unit::Day);

        return $this;
    }

    public function diff(Date|DateImmutable|DateTimeInterface $targetObject, bool $absolute = false): DateInterval
    {
        return $this->date->diff(new self($targetObject)->toDateTime(), $absolute);
    }

    public function isSame(Date|DateImmutable|DateTimeInterface $other): bool
    {
        return $this->date->format('Y-m-d') === new self($other)->format('Y-m-d');
    }

    public function isBefore(Date|DateImmutable|DateTimeInterface $other): bool
    {
        return $this->date->format('Y-m-d') < new self($other)->format('Y-m-d');
    }

    public function isBeforeOrEqual(Date|DateImmutable|DateTimeInterface $other): bool
    {
        return $this->date->format('Y-m-d') <= new self($other)->format('Y-m-d');
    }

    public function isAfter(Date|DateImmutable|DateTimeInterface $other): bool
    {
        return new self($other)->format('Y-m-d') < $this->date->format('Y-m-d');
    }

    public function isAfterOrEqual(Date|DateImmutable|DateTimeInterface $other): bool
    {
        return new self($other)->format('Y-m-d') <= $this->date->format('Y-m-d');
    }

    public function format(string $format): string
    {
        return $this->date->format($format);
    }

    public function getTimezone(): DateTimeZone|false
    {
        return $this->date->getTimezone();
    }

    public function setTimezone(DateTimeZone $timezone): Date
    {
        $this->date->setTimezone($timezone);

        return $this;
    }

    public function toImmutable(): DateImmutable
    {
        return new DateImmutable($this);
    }

    private function setTimeZero(DateTime $datetime): DateTime
    {
        return $datetime->setTime(0, 0);
    }

    private function addModify(int $value, Unit $unit): DateTime
    {
        return $this->modify(Operator::Add, abs($value), $unit);
    }

    private function subModify(int $value, Unit $unit): DateTime
    {
        return $this->modify(Operator::Sub, abs($value), $unit);
    }

    private function modify(Operator $operator, int $value, Unit $unit): DateTime
    {
        $modifiedDate = clone $this->date;

        $modifiedDate->modify($operator->value . abs($value) . $unit->value);

        if ($unit->isOverflow() && $modifiedDate->format('d') !== $this->date->format('d')) {
            return $modifiedDate->modify('last day of previous month');
        }

        return $modifiedDate;
    }

    private function toDateTime(): DateTime
    {
        return $this->date;
    }
}
