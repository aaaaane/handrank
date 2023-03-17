<?php

declare(strict_types=1);

namespace Handrank\Adapters\Controllers\Validators;

use Handrank\Application\Domain\Number;
use Handrank\Application\Domain\Suite;
use Handrank\Traits\CanGetNumbersForCards;
use Handrank\Traits\CanGetSuitesForCards;

class ContentFromFileValidator
{

    use CanGetNumbersForCards, CanGetSuitesForCards;

    /** @const string */
    public const INVALID_CARD_NUMBER = 'invalid_card_number';
    public const INVALID_NUMBER_OF_CARDS = 'invalid_number_of_cards';
    public const INVALID_SUITE = 'invalid_suite';

    public function __construct
    (
        private readonly string $content,
        private bool            $hasError = false,
        private array           $error = []
    )
    {
        $this->validate();
    }

    public function hasError(): bool
    {
        return $this->hasError;
    }

    public function getError(): ?array
    {
        return $this->error;
    }

    public static function create(string $content): self
    {
        return new self($content);
    }

    private function validate(): void
    {
        $contentToArray = explode(PHP_EOL, $this->content);

        $this->validateNumberOfCards($contentToArray);
        $this->validateNumberInCards($contentToArray);
        $this->validateSuiteInCards($contentToArray);
    }

    /**
     * @param string[] $deck
     */
    private function validateNumberOfCards(array $deck): void
    {
        foreach ($deck as $line) {
            $hand = explode(' ', $line);

            if (count($hand) !== 5) {
                $this->error[self::INVALID_NUMBER_OF_CARDS] = 'Number of cards invalid in hand: ' . count($hand);
                $this->hasError = true;
                return;
            }
        }
    }

    /**
     * @param string[] $deck
     */
    private function validateNumberInCards(array $deck): void
    {
        foreach ($deck as $hand) {
            $cardNumbers = $this->getCardNumbersFromHand($hand);

            foreach ($cardNumbers as $number) {
                if ($this->numberIsValid($number) === false) {
                    return;
                }
            }
        }
    }

    private function validateSuiteInCards(array $deck): bool
    {
        foreach ($deck as $hand) {
            $suites = $this->getCardSuitesFromHand($hand);

            foreach ($suites as $suite) {
                if ($this->suiteIsValid($suite) === false) {
                    return false;
                }
            }
        }

        return true;
    }

    private function numberIsValid(string|int $number): bool
    {
        if (in_array($number, Number::LIST) === false) {
            $this->error[self::INVALID_CARD_NUMBER] = 'Number on card not valid: ' . $number;
            $this->hasError = true;

            return false;
        }

        return true;
    }

    private function suiteIsValid(string $suite): bool
    {
        switch ($suite) {
            case Suite::CLUBS->value:
            case Suite::DIAMONDS->value:
            case Suite::HEARTS->value:
            case Suite::SPADES->value:
                return true;

            default:
                $this->error[self::INVALID_SUITE] = 'Suite on card not valid: ' . $suite;
                $this->hasError = true;
                return false;
        }
    }
}
