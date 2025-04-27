<?php

declare(strict_types=1);

namespace Tests\DateType\ImmutableDate;

use DateTime;
use DateTimeImmutable;
use DateType\ImmutableDate;
use DateType\MutableDate;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DiffTest extends TestCase
{
    #[Test]
    public function diffFromDateTime(): void
    {
        $date = new ImmutableDate('2025-01-01 10:30:45.080607');

        $other = new DateTime('2026-02-02 10:30:45.080607');

        $diff = $date->diff($other);

        $this->assertSame(1, $diff->y);
        $this->assertSame(1, $diff->m);
        $this->assertSame(1, $diff->d);
        $this->assertSame(0, $diff->h);
        $this->assertSame(0, $diff->i);
        $this->assertSame(0, $diff->s);
        $this->assertSame(0.0, $diff->f);
    }

    #[Test]
    public function diffFromDateTimeImmutable(): void
    {
        $date = new ImmutableDate('2025-01-01 10:30:45.080607');

        $other = new DateTimeImmutable('2026-02-02 10:30:45.080607');

        $diff = $date->diff($other);

        $this->assertSame(1, $diff->y);
        $this->assertSame(1, $diff->m);
        $this->assertSame(1, $diff->d);
        $this->assertSame(0, $diff->h);
        $this->assertSame(0, $diff->i);
        $this->assertSame(0, $diff->s);
        $this->assertSame(0.0, $diff->f);
    }

    #[Test]
    public function diffFromMutableDate(): void
    {
        $date = new ImmutableDate('2025-01-01 10:30:45.080607');

        $other = new MutableDate('2026-02-02 10:30:45.080607');

        $diff = $date->diff($other);

        $this->assertSame(1, $diff->y);
        $this->assertSame(1, $diff->m);
        $this->assertSame(1, $diff->d);
        $this->assertSame(0, $diff->h);
        $this->assertSame(0, $diff->i);
        $this->assertSame(0, $diff->s);
        $this->assertSame(0.0, $diff->f);
    }

    #[Test]
    public function diffFromImmutableDate(): void
    {
        $date = new ImmutableDate('2025-01-01 10:30:45.080607');

        $other = new ImmutableDate('2026-02-02 10:30:45.080607');

        $diff = $date->diff($other);

        $this->assertSame(1, $diff->y);
        $this->assertSame(1, $diff->m);
        $this->assertSame(1, $diff->d);
        $this->assertSame(0, $diff->h);
        $this->assertSame(0, $diff->i);
        $this->assertSame(0, $diff->s);
        $this->assertSame(0.0, $diff->f);
    }
}
