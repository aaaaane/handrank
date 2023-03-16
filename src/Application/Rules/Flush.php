<?php

declare(strict_types=1);

namespace Handrank\Application\Rules;

use Handrank\Application\Domain\Card;
use Handrank\Application\Domain\Hand;

class Flush extends AbstractRule
{
    /**
     * @const int
     */
    private const RANK = 5;


    public function validate(Hand $hand): RuleResponse
    {
        $isFlush = $this->isFlush($hand->cards());

        return $this->createRuleResponse
        (
            hand: $hand,
            rank: self::RANK,
            matches: $isFlush
        );
    }

    /**
     * @param Card[] $cards
     */
    private function isFlush(array $cards): bool
    {
        $suites = Card::getSuitesFromCards($cards);

        return count(array_unique($suites)) === 1;
    }
}
