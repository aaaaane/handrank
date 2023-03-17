<?php

declare(strict_types=1);

namespace Handrank\Tests\Application\Rules;

use Handrank\Application\Domain\Card;
use Handrank\Application\Domain\Hand;
use Handrank\Application\Domain\Number;
use Handrank\Application\Domain\Suite;
use Handrank\Application\Rules\RoyalFlush;
use PHPUnit\Framework\TestCase;

class RoyalFlushTest extends TestCase
{
    /** @test */
    public function isRoyalFlush()
    {
        $hand = new Hand(
            [
                new Card(
                    new Number('J'),
                    Suite::SPADES,
                ),
                new Card(
                    new Number('A'),
                    Suite::HEARTS,
                ),
                new Card(
                    new Number(10),
                    Suite::CLUBS,
                ),
                new Card(
                    new Number('K'),
                    Suite::DIAMONDS,
                ),
                new Card(
                    new Number('Q'),
                    Suite::CLUBS,
                ),
            ]);

        $royalFlush = new RoyalFlush();
        $royalFlushResponse = $royalFlush->validate($hand);

        $this->assertTrue($royalFlushResponse->getMatches());
    }

    /** @test */
    public function isNotRoyalFlush()
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

        $royalFlush = new RoyalFlush();
        $royalFlushResponse = $royalFlush->validate($hand);

        $this->assertFalse($royalFlushResponse->getMatches());
    }
}
