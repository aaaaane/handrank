<?php

declare(strict_types=1);

namespace Handrank\Application\Rules;

use Handrank\Application\Domain\Card;
use Handrank\Application\Domain\Hand;

class Pair extends AbstractRule
{
    /**
     * @const int
     */
    private const RANK = 9;

    public function validate(Hand $hand): RuleResponse
    {
        $isPair = $this->isPair($hand->cards());

        return $this->createRuleResponse
        (
            hand: $hand,
            rank: self::RANK,
            matches: $isPair
        );
    }

    /**
     * @param Card[] $cards
     */
    private function isPair(array $cards): bool
    {
        $numbers = Card::getNumbersFromCards($cards);

        $numberOccurrences = array_count_values($numbers);

        return in_array(2, $numberOccurrences, true)
            && count($numberOccurrences) === 4;
    }
}
