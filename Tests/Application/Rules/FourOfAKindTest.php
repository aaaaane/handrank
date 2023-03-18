<?php

declare(strict_types=1);

namespace Handrank\Tests\Application\Rules;

use Handrank\Application\Domain\Card;
use Handrank\Application\Domain\Hand;
use Handrank\Application\Domain\Number;
use Handrank\Application\Domain\Suite;
use Handrank\Application\Rules\FourOfAKind;
use PHPUnit\Framework\TestCase;

class FourOfAKindTest extends TestCase
{
    /** @test */
    public function isFourOfAKind()
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
                new Number('J'),
                Suite::CLUBS,
            ),
            new Card(
                new Number('J'),
                Suite::DIAMONDS,
            ),
            new Card(
                new Number(9),
                Suite::CLUBS,
            ),
        ]);

        $fourOfAKind = new FourOfAKind();
        $fourOfAKindResponse = $fourOfAKind->validate($hand);

        $this->assertTrue($fourOfAKindResponse->getMatches());
    }

    /** @test */
    public function isNotFourOfAKind()
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
                    new Number('J'),
                    Suite::CLUBS,
                ),
                new Card(
                    new Number('Q'),
                    Suite::DIAMONDS,
                ),
                new Card(
                    new Number(9),
                    Suite::CLUBS,
                ),
            ]);

        $fourOfAKind = new FourOfAKind();
        $fourOfAKindResponse = $fourOfAKind->validate($hand);

        $this->assertFalse($fourOfAKindResponse->getMatches());
    }
}
