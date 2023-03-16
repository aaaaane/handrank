<?php

declare(strict_types=1);

namespace Handrank\Application\Rules;

use Handrank\Application\Domain\Card;
use Handrank\Application\Domain\Hand;

class FourOfAKind extends AbstractRule
{
    /**
     * @const int
     */
    private const RANK = 3;

    public function validate(Hand $hand): RuleResponse
    {
        $isFourOfAKind = $this->isFourOfAKind($hand->cards());

        return $this->createRuleResponse
        (
            hand: $hand,
            rank: self::RANK,
            matches: $isFourOfAKind
        );
    }

    /**
     * @param Card[] $cards
     */
    private function isFourOfAKind(array $cards): bool
    {
        $numbers = Card::getNumbersFromCards($cards);

        $numberOccurrences = array_count_values($numbers);
        if (in_array(4, $numberOccurrences)) {
            return true;
        }

        return false;
    }
}
