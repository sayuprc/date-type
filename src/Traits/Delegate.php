<?php

declare(strict_types=1);

namespace DateType\Traits;

use DateTimeZone;
use Override;

/**
 * Provides simple delegation for common DateTime/DateTimeImmutable methods.
 */
trait Delegate
{
    #[Override]
    public function format(string $format): string
    {
        return parent::format($format);
    }

    #[Override]
    public function getMicrosecond(): int
    {
        return parent::getMicrosecond();
    }

    #[Override]
    public function getTimestamp(): int
    {
        return parent::getTimestamp();
    }

    #[Override]
    public function getTimezone(): DateTimeZone|false
    {
        return parent::getTimezone();
    }

    #[Override]
    public function getOffset(): int
    {
        return parent::getOffset();
    }

    /**
     * @param array<mixed> $array
     */
    #[Override]
    public static function __set_state(array $array): static
    {
        return self::create(parent::__set_state($array));
    }

    #[Override]
    public function __serialize(): array
    {
        return parent::__serialize();
    }

    /**
     * @param array<mixed> $data
     */
    #[Override]
    public function __unserialize(array $data): void
    {
        parent::__unserialize($data);
    }

    #[Override]
    public function __wakeup(): void
    {
        parent::__wakeup();
    }
}
