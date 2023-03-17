<?php

declare(strict_types=1);

namespace Handrank\Tests\Application\Rules;

use Handrank\Application\Domain\Card;
use Handrank\Application\Domain\Hand;
use Handrank\Application\Domain\Number;
use Handrank\Application\Domain\Suite;
use Handrank\Application\Rules\ThreeOfAKind;
use PHPUnit\Framework\TestCase;

class ThreeOfAKindTest extends TestCase
{
    /** @test */
    public function isThreeOfAKind()
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
                    new Number(2),
                    Suite::HEARTS,
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

        $threeOfAKind = new ThreeOfAKind();
        $threeOfAKindResponse = $threeOfAKind->validate($hand);

        $this->assertTrue($threeOfAKindResponse->getMatches());
    }

    /** @test */
    public function isNotThreeOfAKind()
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

        $threeOfAKind = new ThreeOfAKind();
        $threeOfAKindResponse = $threeOfAKind->validate($hand);

        $this->assertFalse($threeOfAKindResponse->getMatches());
    }
}
