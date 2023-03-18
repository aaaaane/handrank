<?php

declare(strict_types=1);

namespace Handrank\Application\Rules;

use Handrank\Application\Domain\Hand;

class RuleResponse
{

    public function __construct
    (
        private readonly Hand $hand,
        private readonly int $rank,
        private readonly bool $matches
    )
    {
    }

    public function getHand(): Hand
    {
        return $this->hand;
    }

    public function getRank(): int
    {
        return $this->rank;
    }

    public function getMatches(): bool
    {
        return $this->matches;
    }
}
