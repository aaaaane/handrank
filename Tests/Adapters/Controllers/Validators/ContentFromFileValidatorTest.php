<?php

declare(strict_types=1);


namespace Handrank\Tests\Adapters\Controllers\Validators;

use Handrank\Adapters\Controllers\Validators\ContentFromFileValidator;
use Handrank\Application\Domain\Card;
use Handrank\Application\Domain\Hand;
use Handrank\Application\Domain\Number;
use Handrank\Application\Domain\Suite;
use Handrank\Application\Rules\TwoPair;
use PHPUnit\Framework\TestCase;

class ContentFromFileValidatorTest extends TestCase
{

    /** @test */
    public function canValidateContent()
    {
        $contentFromFile = '10♥ 10♦ 10♠ 9♣ 9♦' . PHP_EOL . '4♠ J♠ 8♠ 2♠ 9♠' . PHP_EOL . '3♦ J♣ 8♠ 4♥ 2♠';

        $contentFromFileValidator = ContentFromFileValidator::create($contentFromFile);

        $this->assertTrue(empty($contentFromFileValidator->getError()));
        $this->assertFalse($contentFromFileValidator->hasError());
    }

    /** @test */
    public function canValidateInvalidNumberOfCardsInHand()
    {
        $contentFromFile = '10♥ 10♦ 10♠ 9♣ 9♦' . PHP_EOL . '4♠ J♠ 8♠ 2♠ 9♠ 9♠' . PHP_EOL . '3♦ J♣ 8♠ 4♥ 2♠';

        $contentFromFileValidator = ContentFromFileValidator::create($contentFromFile);

        $this->assertFalse(empty($contentFromFileValidator->getError()[ContentFromFileValidator::INVALID_NUMBER_OF_CARDS]));
        $this->assertTrue($contentFromFileValidator->hasError());
    }

    /** @test */
    public function canValidateInvalidNumberInCard()
    {
        $contentFromFile = '17♥ 10♦ 10♠ 9♣ 9♦' . PHP_EOL . '4♠ J♠ 8♠ 2♠ 9♠' . PHP_EOL . '3♦ J♣ 8♠ 4♥ 2♠';

        $contentFromFileValidator = ContentFromFileValidator::create($contentFromFile);

        $this->assertFalse(empty($contentFromFileValidator->getError()[ContentFromFileValidator::INVALID_CARD_NUMBER]));
        $this->assertTrue($contentFromFileValidator->hasError());
    }

    /** @test */
    public function canValidateInvalidSuiteInCard()
    {
        $contentFromFile = '10♥ 10C 10♠ 9♣ 9♦' . PHP_EOL . '4♠ J♠ 8♠ 2♠ 9♠' . PHP_EOL . '3♦ J♣ 8♠ 4♥ 2♠';

        $contentFromFileValidator = ContentFromFileValidator::create($contentFromFile);

        $this->assertFalse(empty($contentFromFileValidator->getError()[ContentFromFileValidator::INVALID_SUITE]));
        $this->assertTrue($contentFromFileValidator->hasError());
    }

    /** @test */
    public function isFourOfAKind()
    {
        $contentFromFile = '10♥ 10♦ 10♠ 9♣ 9♦' . PHP_EOL . '4♠ J♠ 8♠ 2♠ 9♠' . PHP_EOL . '3♦ J♣ 8♠ 4♥ 2♠';

        $hand = new Hand(
            [
                new Card(
                    new Number('J'),
                    Suite::CLUBS,
                ),
                new Card(
                    new Number('J'),
                    Suite::SPADES,
                ),
                new Card(
                    new Number(10),
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

        $TwoPair = new TwoPair();
        $isTwoPair = $TwoPair->validate($hand);
        var_dump($isTwoPair);
    }



}
