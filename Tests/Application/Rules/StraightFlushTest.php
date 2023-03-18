<?php

declare(strict_types=1);

namespace Handrank\Tests\Application\Rules;

use Handrank\Application\Domain\Card;
use Handrank\Application\Domain\Hand;
use Handrank\Application\Domain\Number;
use Handrank\Application\Domain\Suite;
use Handrank\Application\Rules\StraightFlush;
use PHPUnit\Framework\TestCase;

class StraightFlushTest extends TestCase
{
    /** @test */
    public function isStraightFlush()
    {
        $hand = new Hand(
            [
                new Card(
                    new Number(2),
                    Suite::DIAMONDS,
                ),
                new Card(
                    new Number(3),
                    Suite::DIAMONDS,
                ),
                new Card(
                    new Number(4),
                    Suite::DIAMONDS,
                ),
                new Card(
                    new Number(5),
                    Suite::DIAMONDS,
                ),
                new Card(
                    new Number(6),
                    Suite::DIAMONDS,
                ),
            ]);

        $straightFlush = new StraightFlush();
        $straightFlushResponse = $straightFlush->validate($hand);

        $this->assertTrue($straightFlushResponse->getMatches());
    }

    /** @test */
    public function isNotStraightFlush()
    {
        $hand = new Hand(
            [
                new Card(
                    new Number('J'),
                    Suite::SPADES,
                ),
                new Card(
                    new Number('J'),
                    Suite::HEARTS,
                ),
                new Card(
                    new Number('K'),
                    Suite::CLUBS,
                ),
                new Card(
                    new Number('Q'),
                    Suite::DIAMONDS,
                ),
                new Card(
                    new Number('Q'),
                    Suite::CLUBS,
                ),
            ]);

        $straightFlush = new StraightFlush();
        $straightFlushResponse = $straightFlush->validate($hand);

        $this->assertFalse($straightFlushResponse->getMatches());
    }
}
