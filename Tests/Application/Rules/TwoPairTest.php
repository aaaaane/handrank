<?php

declare(strict_types=1);


namespace Handrank\Tests\Application\Rules;

use Handrank\Application\Domain\Card;
use Handrank\Application\Domain\Hand;
use Handrank\Application\Domain\Number;
use Handrank\Application\Domain\Suite;
use Handrank\Application\Rules\ThreeOfAKind;
use Handrank\Application\Rules\TwoPair;
use PHPUnit\Framework\TestCase;

class TwoPairTest extends TestCase
{
    /** @test */
    public function isTwoPair()
    {
        $hand = new Hand(
            [
                new Card(
                    new Number(2),
                    Suite::DIAMONDS,
                ),
                new Card(
                    new Number(2),
                    Suite::CLUBS,
                ),
                new Card(
                    new Number(5),
                    Suite::HEARTS,
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

        $twoPair = new TwoPair();
        $twoPairResponse = $twoPair->validate($hand);

        $this->assertTrue($twoPairResponse->getMatches());
    }

    /** @test */
    public function isNotTwoPair()
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
                    new Number(2),
                    Suite::DIAMONDS,
                ),
                new Card(
                    new Number('Q'),
                    Suite::CLUBS,
                ),
            ]);

        $twoPair = new TwoPair();
        $twoPairResponse = $twoPair->validate($hand);

        $this->assertFalse($twoPairResponse->getMatches());
    }
}
