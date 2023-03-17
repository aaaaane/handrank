<?php

declare(strict_types=1);

namespace Handrank\Tests\Application\Rules;

use Handrank\Application\Domain\Card;
use Handrank\Application\Domain\Hand;
use Handrank\Application\Domain\Number;
use Handrank\Application\Domain\Suite;
use Handrank\Application\Rules\Flush;
use PHPUnit\Framework\TestCase;

class FlushTest extends TestCase
{
    /** @test */
    public function isFlushTest()
    {
        $hand = new Hand(
            [
                new Card(
                    new Number('J'),
                    Suite::CLUBS,
                ),
                new Card(
                    new Number(2),
                    Suite::CLUBS,
                ),
                new Card(
                    new Number(5),
                    Suite::CLUBS,
                ),
                new Card(
                    new Number(10),
                    Suite::CLUBS,
                ),
                new Card(
                    new Number(9),
                    Suite::CLUBS,
                ),
            ]);

        $flush = new Flush();
        $flushResponse = $flush->validate($hand);

        $this->assertTrue($flushResponse->getMatches());
    }

    /** @test */
    public function isNotFlushTest()
    {
        $hand = new Hand(
            [
                new Card(
                    new Number('J'),
                    Suite::CLUBS,
                ),
                new Card(
                    new Number(2),
                    Suite::HEARTS,
                ),
                new Card(
                    new Number(5),
                    Suite::CLUBS,
                ),
                new Card(
                    new Number(10),
                    Suite::CLUBS,
                ),
                new Card(
                    new Number(9),
                    Suite::CLUBS,
                ),
            ]);

        $flush = new Flush();
        $flushResponse = $flush->validate($hand);

        $this->assertFalse($flushResponse->getMatches());
    }
}
