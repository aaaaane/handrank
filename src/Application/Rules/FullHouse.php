<?php

declare(strict_types=1);

namespace Handrank\Application\Rules;

use Handrank\Application\Domain\Card;
use Handrank\Application\Domain\Hand;

class FullHouse extends AbstractRule
{
    /**
     * @const int
     */
    private const RANK = 4;

    public function validate(Hand $hand): RuleResponse
    {
        $isFullHouse = $this->isFullHouse($hand->cards());

        return $this->createRuleResponse
        (
            hand: $hand,
            rank: self::RANK,
            matches: $isFullHouse
        );
    }

    /**
     * @param Card[] $cards
     */
    private function isFullHouse(array $cards): bool
    {
        $numbers = Card::getNumbersFromCards($cards);
        $uniqueOccurrences = array_count_values($numbers);

        return count($uniqueOccurrences) === 2
            && in_array(2, $uniqueOccurrences, true)
            && in_array(3, $uniqueOccurrences, true);
    }
}
