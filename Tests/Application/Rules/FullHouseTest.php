<?php

declare(strict_types=1);

namespace Handrank\Tests\Application\Rules;

use Handrank\Application\Domain\Card;
use Handrank\Application\Domain\Hand;
use Handrank\Application\Domain\Number;
use Handrank\Application\Domain\Suite;
use Handrank\Application\Rules\FullHouse;
use PHPUnit\Framework\TestCase;

class FullHouseTest extends TestCase
{
    /** @test */
    public function isFullHouse()
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
                    new Number('Q'),
                    Suite::CLUBS,
                ),
            ]);

        $fullHouse = new FullHouse();
        $fullHouseResponse = $fullHouse->validate($hand);

        $this->assertTrue($fullHouseResponse->getMatches());
    }

    /** @test */
    public function isNotFullHouse()
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

        $fullHouse = new FullHouse();
        $fullHouseResponse = $fullHouse->validate($hand);

        $this->assertFalse($fullHouseResponse->getMatches());
    }
}
