<?php

declare(strict_types=1);

namespace DateType\ImmutableDate;

use DateType\ImmutableDate;
use DateType\MutableDate;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ToMutableTest extends TestCase
{
    #[Test]
    public function toMutable(): void
    {
        $this->assertInstanceOf(MutableDate::class, new ImmutableDate()->toMutable());
    }
}
