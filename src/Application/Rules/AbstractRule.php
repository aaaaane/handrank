<?php

declare(strict_types=1);

namespace Handrank\Application\Rules;

use Handrank\Application\Domain\Hand;
use Handrank\Application\Rules\Contracts\Rule as RuleContract;

abstract class AbstractRule implements RuleContract
{

    public function __construct(protected array $ruleResponse = [])
    {
    }

    protected function createRuleResponse
    (
        Hand $hand,
        int  $rank,
        bool $matches
    ): RuleResponse
    {
        return new RuleResponse(
            hand: $hand,
            rank: $rank,
            matches: $matches
        );
    }
}
