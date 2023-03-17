<?php

declare(strict_types=1);

namespace Handrank\Tests\Application\Rules;

use Handrank\Application\Domain\Card;
use Handrank\Application\Domain\Hand;
use Handrank\Application\Domain\Number;
use Handrank\Application\Domain\Suite;
use Handrank\Application\Rules\Pair;
use PHPUnit\Framework\TestCase;

class PairTest extends TestCase
{
    /** @test */
    public function isPair()
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
                    new Number(2),
                    Suite::CLUBS,
                ),
                new Card(
                    new Number(6),
                    Suite::DIAMONDS,
                ),
                new Card(
                    new Number('Q'),
                    Suite::CLUBS,
                ),
            ]);

        $pair = new Pair();
        $pairResponse = $pair->validate($hand);

        $this->assertTrue($pairResponse->getMatches());
    }

    /** @test */
    public function isNotPair()
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

        $pair = new Pair();
        $pairResponse = $pair->validate($hand);

        $this->assertFalse($pairResponse->getMatches());
    }
}
