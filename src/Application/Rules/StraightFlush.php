<?php

declare(strict_types=1);

namespace Handrank\Application\Rules;

use Handrank\Application\Domain\Hand;

class StraightFlush extends AbstractRule
{
    /**
     * @const int
     */
    private const RANK = 2;

    public function validate(Hand $hand): RuleResponse
    {
        $isStraightFlush = $this->isStraightFlush($hand);

        return $this->createRuleResponse
        (
            hand: $hand,
            rank: self::RANK,
            matches: $isStraightFlush
        );
    }

    private function isStraightFlush(Hand $hand): bool
    {
        $flush = (new Flush())->validate($hand);
        $straight = (new Straight())->validate($hand);

        return $flush->getMatches() && $straight->getMatches();
    }
}
