<?php

declare(strict_types=1);

namespace DateType\Traits;

use DateTimeInterface;
use DateTimeZone;
use Override;

trait Factory
{
    #[Override]
    public static function createFromFormat(string $format, string $datetime, ?DateTimeZone $timezone = null): false|static
    {
        $createdDateTime = parent::createFromFormat($format, $datetime, $timezone);

        if ($createdDateTime === false) {
            return false;
        }

        return self::create($createdDateTime);
    }

    #[Override]
    public static function createFromInterface(DateTimeInterface $object): static
    {
        return self::create(parent::createFromInterface($object));
    }

    #[Override]
    public static function createFromTimestamp(float|int $timestamp): static
    {
        return self::create(parent::createFromTimestamp($timestamp));
    }

    private static function create(DateTimeInterface $dateTime): static
    {
        return new static($dateTime->format('Y-m-d H:i:s.u'), $dateTime->getTimezone());
    }
}
