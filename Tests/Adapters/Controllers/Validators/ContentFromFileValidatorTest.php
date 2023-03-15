<?php

declare(strict_types=1);


namespace Handrank\Tests\Adapters\Controllers\Validators;

use Handrank\Adapters\Controllers\Validators\ContentFromFileValidator;
use PHPUnit\Framework\TestCase;

class ContentFromFileValidatorTest extends TestCase
{

    /** @test */
    public function canValidateContent()
    {
        $contentFromFile = '10♥ 10♦ 10♠ 9♣ 9♦' . PHP_EOL . '4♠ J♠ 8♠ 2♠ 9♠' . PHP_EOL . '3♦ J♣ 8♠ 4♥ 2♠';

        $contentFromFileValidator = ContentFromFileValidator::create($contentFromFile);

        $this->assertTrue(empty($contentFromFileValidator->getError()));
    }

    /** @test */
    public function canValidateInvalidNumberOfCardsInHand()
    {
        $contentFromFile = '10♥ 10♦ 10♠ 9♣ 9♦' . PHP_EOL . '4♠ J♠ 8♠ 2♠ 9♠ 9♠' . PHP_EOL . '3♦ J♣ 8♠ 4♥ 2♠';

        $contentFromFileValidator = ContentFromFileValidator::create($contentFromFile);

        $this->assertFalse(empty($contentFromFileValidator->getError()['invalid_number_of_cards']));
    }

    /** @test */
    public function canValidateInvalidNumberInCard()
    {
        $contentFromFile = '17♥ 10♦ 10♠ 9♣ 9♦' . PHP_EOL . '4♠ J♠ 8♠ 2♠ 9♠' . PHP_EOL . '3♦ J♣ 8♠ 4♥ 2♠';

        $contentFromFileValidator = ContentFromFileValidator::create($contentFromFile);

        $this->assertFalse(empty($contentFromFileValidator->getError()['invalid_card_number']));
    }

    /** @test */
    public function canValidateInvalidSuiteInCard()
    {
        $contentFromFile = '10♥ 10C 10♠ 9♣ 9♦' . PHP_EOL . '4♠ J♠ 8♠ 2♠ 9♠' . PHP_EOL . '3♦ J♣ 8♠ 4♥ 2♠';

        $contentFromFileValidator = ContentFromFileValidator::create($contentFromFile);

        $this->assertFalse(empty($contentFromFileValidator->getError()['invalid_suite']));
    }
}
