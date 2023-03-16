<?php

declare(strict_types=1);

namespace Handrank\Application\Rules;

use Handrank\Application\Domain\Card;
use Handrank\Application\Domain\Hand;

class TwoPair extends AbstractRule
{
    /**
     * @const int
     */
    private const RANK = 8;

    public function validate(Hand $hand): RuleResponse
    {
        $isTwoPair = $this->isTwoPair($hand->cards());

        return $this->createRuleResponse
        (
            hand: $hand,
            rank: self::RANK,
            matches: $isTwoPair
        );
    }

    /**
     * @param Card[] $cards
     */
    private function isTwoPair(array $cards): bool
    {
        $numbers = Card::getNumbersFromCards($cards);

        $numberOccurrences = array_count_values($numbers);

        return in_array(2, $numberOccurrences, true)
            && count($numberOccurrences) === 3;
    }
}
