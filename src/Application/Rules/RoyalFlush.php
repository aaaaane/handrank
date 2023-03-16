<?php

declare(strict_types=1);

namespace Handrank\Application\Rules;

use Handrank\Application\Domain\Card;
use Handrank\Application\Domain\Hand;

class RoyalFlush extends AbstractRule
{
    /**
     * @const int
     */
    private const RANK = 1;

    private array $neededNumbers = [10, 'J', 'Q', 'K', 'A',];

    public function validate(Hand $hand): RuleResponse
    {
        $isRoyalFlush = $this->isRoyalFlush($hand->cards());

        return $this->createRuleResponse
        (
            hand: $hand,
            rank: self::RANK,
            matches: $isRoyalFlush
        );
    }

    /**
     * @param Card[] $cards
     */
    private function isRoyalFlush(array $cards): bool
    {
        $numbers = Card::getNumbersFromCards($cards);

        foreach ($this->neededNumbers as $neededNumber) {
            if (in_array($neededNumber, $numbers) === false) {
                return false;
            }
        }

        return true;
    }
}
