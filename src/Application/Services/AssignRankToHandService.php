<?php

declare(strict_types=1);

namespace Handrank\Application\Services;

use Handrank\Application\Domain\Hand;
use Handrank\Application\Rules\Flush;
use Handrank\Application\Rules\FourOfAKind;
use Handrank\Application\Rules\FullHouse;
use Handrank\Application\Rules\HighCard;
use Handrank\Application\Rules\Pair;
use Handrank\Application\Rules\RoyalFlush;
use Handrank\Application\Rules\RuleResponse;
use Handrank\Application\Rules\Straight;
use Handrank\Application\Rules\StraightFlush;
use Handrank\Application\Rules\ThreeOfAKind;
use Handrank\Application\Rules\TwoPair;

class AssignRankToHandService
{
    public function __construct()
    {
    }

    public function runRulesValidation(Hand $hand): RuleResponse
    {
        $rulesRanking =
            [
                new RoyalFlush(),
                new StraightFlush(),
                new FourOfAKind(),
                new FullHouse(),
                new Flush(),
                new Straight(),
                new ThreeOfAKind(),
                new TwoPair(),
                new Pair(),
                new HighCard(),
            ];

        foreach ($rulesRanking as $ruleRanking) {
            $validationResponse = $ruleRanking->validate($hand);

            if ($validationResponse->getMatches() === true) {
                return $validationResponse;
            }
        }

        return $validationResponse;
    }
}
