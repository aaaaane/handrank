<?php

declare(strict_types=1);

namespace Handrank\Application\Rules;

use Handrank\Application\Domain\Card;
use Handrank\Application\Domain\Hand;
use Handrank\Application\Domain\Number;
use function Handrank\Rules\array_search;

class Straight extends AbstractRule
{
    /**
     * @const int
     */
    private const RANK = 6;

    private array $numberSequence = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13,];

    public function validate(Hand $hand): RuleResponse
    {
//        var_dump('hand: \n');
//        var_dump($hand);
        $isStraight = $this->isStraight($hand->cards());

        return $this->createRuleResponse
        (
            hand: $hand,
            rank: self::RANK,
            matches: $isStraight
        );
    }

    /**
     * @param Card[] $cards
     */
    private function isStraight(array $cards): bool
    {
        $numbers = Card::getNumbersFromCards($cards);
        $numbersToInt = [];

        foreach ($numbers as $cardNumber) {
            $numbersToInt[] = $this->numberOfCardToInt($cardNumber);
        }

        sort($numbersToInt, 1);

        return $this->numbersAreConsecutive($numbersToInt);
    }

    private function numberOfCardToInt(string|int $cardNumber): int
    {
        return Number::ranktoNumber($cardNumber);
    }

    /**
     * @param int $numbers
     */
    private function numbersAreConsecutive(array $numbers): bool
    {
        $positions = [];
        // Here we get the position that occupies each card number in $this->numberSequence
        foreach ($numbers as $number) {
            $positions[] = \array_search($number, $this->numberSequence);
        }

        $initialPosition = $positions[0];
        $oldPosition = null;

        foreach ($positions as $position) {

            if (
                $position !== $initialPosition &&
                $oldPosition !== null
            ) {
                // Here we check if the actual position and the oldPosition + 1 are the same
                // or if the oldPosition is 0 (which means is an Ace or 1) and the actual
                // position is 9 (which means is the number 10) because from 10 we can do a
                // straight doing -> 10, J, Q, K, A, but since I order by value the array
                // the cards are always going to be ordered in ascendant order.
                if (
                    $position === $oldPosition + 1 ||
                    $oldPosition === 0 && $position === 9
                ) {
                    $oldPosition = $position;
                    continue;
                } else {
                    return false;
                }
            }
            $oldPosition = $position;
        }

        return true;
    }
}
