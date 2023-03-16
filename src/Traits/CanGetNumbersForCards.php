<?php

declare(strict_types=1);

namespace Handrank\Traits;

trait CanGetNumbersForCards
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

    /**
     * @param string $card
     * @return string|int
     */
    protected function getNumbersForCard(string $card)
    {
        $number = mb_substr($card, 0, -1);

        if (is_numeric($number) === true) {
            $number = (int)$number;
        }

        return $number;
    }
}
