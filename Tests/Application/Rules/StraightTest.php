<?php

declare(strict_types=1);

namespace Handrank\Tests\Application\Rules;

use Handrank\Application\Domain\Card;
use Handrank\Application\Domain\Hand;
use Handrank\Application\Domain\Number;
use Handrank\Application\Domain\Suite;
use Handrank\Application\Rules\Straight;
use PHPUnit\Framework\TestCase;

class StraightTest extends TestCase
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
                    Suite::CLUBS,
                ),
                new Card(
                    new Number(4),
                    Suite::DIAMONDS,
                ),
                new Card(
                    new Number(5),
                    Suite::HEARTS,
                ),
                new Card(
                    new Number(6),
                    Suite::DIAMONDS,
                ),
            ]);

        $straight = new Straight();
        $straightResponse = $straight->validate($hand);

        $this->assertTrue($straightResponse->getMatches());
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

        $straight = new Straight();
        $straightResponse = $straight->validate($hand);

        $this->assertFalse($straightResponse->getMatches());
    }
}
