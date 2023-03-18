<?php

declare(strict_types=1);

namespace Handrank\Tests\Application\Rules;

use Handrank\Application\Domain\Card;
use Handrank\Application\Domain\Hand;
use Handrank\Application\Domain\Number;
use Handrank\Application\Domain\Suite;
use Handrank\Application\Rules\HighCard;
use PHPUnit\Framework\TestCase;

class HighCardTest extends TestCase
{
    /** @test */
    public function isHighCard()
    {
        $hand = new Hand(
            [
                new Card(
                    new Number('J'),
                    Suite::SPADES,
                ),
                new Card(
                    new Number(5),
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

        $highCard = new HighCard();
        $highCardResponse = $highCard->validate($hand);

        $this->assertTrue($highCardResponse->getMatches());
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

        $highCard = new HighCard();
        $highCardResponse = $highCard->validate($hand);

        $this->assertFalse($highCardResponse->getMatches());
    }
}
