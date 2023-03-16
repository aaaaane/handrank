<?php

declare(strict_types=1);

namespace Handrank\Application\Rules;

use Handrank\Application\Domain\Card;
use Handrank\Application\Domain\Hand;

class ThreeOfAKind extends AbstractRule
{
    /**
     * @const int
     */
    private const RANK = 7;

    public function validate(Hand $hand): RuleResponse
    {
        $isThreeOfAKind = $this->isThreeOfAKind($hand->cards());

        return $this->createRuleResponse
        (
            hand: $hand,
            rank: self::RANK,
            matches: $isThreeOfAKind
        );
    }

    /**
     * @param Card[] $cards
     */
    private function isThreeOfAKind(array $cards): bool
    {
        $numbers = Card::getNumbersFromCards($cards);

        $numberOccurrences = array_count_values($numbers);
        if (in_array(3, $numberOccurrences)) {
            return true;
        }

        return false;
    }
}
