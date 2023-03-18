<?php

declare(strict_types=1);

namespace Handrank\App\Helpers;
abstract class CardValuesHelper
{
    /**
     * @return string[]
     */
    protected function getCardNumbersFromHand(string $hand): array
    {
        $arrayHand = explode(' ', $hand);
        $numbers = [];

        foreach ($arrayHand as $card) {
            $numbers[] = $this->getNumbersForCard($card);
        }

        return $numbers;
    }

    protected function getNumbersForCard(string $card): string|int
    {
        $number = mb_substr($card, 0, -1);

        if (is_numeric($number) === true) {
            $number = (int)$number;
        }

        return $number;
    }

    protected function getCardSuitesFromHand(string $hand): array
    {
        $arrayHand = explode(' ', $hand);
        $suites = [];

        foreach ($arrayHand as $card) {
            $suites[] = $this->getSuiteForCard($card);
        }

        return $suites;
    }

    protected function getSuiteForCard(string $card): string
    {
        return mb_substr($card, -1, 1, 'utf-8');
    }
}
