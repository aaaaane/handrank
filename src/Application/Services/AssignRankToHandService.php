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
        $royalFlushResponse = (new RoyalFlush())->validate($hand);

        if ($royalFlushResponse->getMatches() === true) {
            return $royalFlushResponse;
        }

        $straightFlushResponse = (new StraightFlush())->validate($hand);

        if ($straightFlushResponse->getMatches() === true) {
            return $straightFlushResponse;
        }

        $fourOfAKindResponse = (new FourOfAKind())->validate($hand);

        if ($fourOfAKindResponse->getMatches() === true) {
            return $fourOfAKindResponse;
        }

        $fullHouseResponse = (new FullHouse())->validate($hand);

        if ($fullHouseResponse->getMatches() === true) {
            return $fullHouseResponse;
        }

        $flushResponse = (new Flush())->validate($hand);

        if ($flushResponse->getMatches() === true) {
            return $flushResponse;
        }

        $straightResponse = (new Straight())->validate($hand);

        if ($straightResponse->getMatches() === true) {
            return $straightResponse;
        }

        $threeOfAKindResponse = (new ThreeOfAKind())->validate($hand);

        if ($threeOfAKindResponse->getMatches() === true) {
            return $threeOfAKindResponse;
        }

        $twoPairResponse = (new TwoPair())->validate($hand);

        if ($twoPairResponse->getMatches() === true) {
            return $twoPairResponse;
        }

        $pairResponse = (new Pair())->validate($hand);

        if ($pairResponse->getMatches() === true) {
            return $pairResponse;
        }

        $highCardResponse = (new HighCard())->validate($hand);

        return $highCardResponse;
    }
}
