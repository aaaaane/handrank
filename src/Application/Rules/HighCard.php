<?php

declare(strict_types=1);

namespace Handrank\Application\Rules;

use Handrank\Application\Domain\Card;
use Handrank\Application\Domain\Hand;

class HighCard extends AbstractRule
{
    /**
     * @const int
     */
    private const RANK = 10;

    public function validate(Hand $hand): RuleResponse
    {
        $isHighCard = $this->isHighCard($hand->cards());

        return $this->createRuleResponse
        (
            hand: $hand,
            rank: self::RANK,
            matches: $isHighCard
        );
    }

    /**
     * @param Card[] $cards
     */
    private function isHighCard(array $cards): bool
    {
        $numbers = Card::getNumbersFromCards($cards);

        return count(array_unique($numbers)) === 5;
    }
}
