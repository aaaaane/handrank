<?php

declare(strict_types=1);

namespace Handrank\Adapters\Controllers\Validators;

use Handrank\Application\Domain\Number;
use Handrank\Application\Domain\Suite;

class ContentFromFileValidator
{
    public function __construct
    (
        private readonly string $content,
        private bool            $hasError = false,
        private array     $error = []
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
    private function validateNumberOfCards(array $deck): bool
    {
        foreach ($deck as $line) {
            $hand = explode(' ', $line);

            if (count($hand) !== 5) {
                $this->error['invalid_number_of_cards'] = 'Number of cards invalid in hand: ' . count($hand);
                $this->hasError = true;
                return false;
            }
        }

        return true;
    }

    /**
     * @param string[] $deck
     */
    private function validateNumberInCards(array $deck): bool
    {
        foreach ($deck as $hand) {
            $cardNumbers = $this->getCardNumbersFromHand($hand);

            foreach ($cardNumbers as $number) {
                if ($this->numberIsValid($number) === false) {
                    return false;
                }
            }
        }

        return true;
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

    /**
     * @param string $hand
     * @return string[]
     */
    private function getCardNumbersFromHand(string $hand): array
    {
        $arrayHand = explode(' ', $hand);
        $numbers = [];

        foreach ($arrayHand as $card) {
            $numbers[] = mb_substr($card, 0, -1);
        }

        return $numbers;
    }

    /**
     * @param string $hand
     */
    private function getCardSuitesFromHand(string $hand)
    {
        $arrayHand = explode(' ', $hand);
        $suites = [];

        foreach ($arrayHand as $card) {
            $suites[] = mb_substr($card, -1, 1, 'utf-8');
        }

        return $suites;
    }


    private function numberIsValid(string $number): bool
    {
        if (in_array($number, Number::LIST) === false) {
            $this->error['invalid_card_number'] = 'Number on card not valid: ' . $number;
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
                $this->error['invalid_suite'] = 'Suite on card not valid: ' . $suite;
                $this->hasError = true;
                return false;
        }
    }
}
