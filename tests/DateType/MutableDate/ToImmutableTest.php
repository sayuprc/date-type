<?php

declare(strict_types=1);

namespace Tests\DateType\MutableDate;

use DateType\ImmutableDate;
use DateType\MutableDate;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ToImmutableTest extends TestCase
{
    #[Test]
    public function toImmutable(): void
    {
        $this->assertInstanceOf(ImmutableDate::class, new MutableDate()->toImmutable());
    }
}
