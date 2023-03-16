<?php

declare(strict_types=1);

namespace Handrank\Application\Services;

use Handrank\Application\Domain\Deck;
use Handrank\Application\Domain\Hand;
use Handrank\Application\Dto\DeckDto;
use Handrank\Application\Rules\RuleResponse;

class SortDeckService
{
    public function __construct(private readonly AssignRankToHandService $assignRankToHandService)
    {

    }

    public function sortDeck(DeckDto $deckDto): DeckDto
    {
        $deck = Deck::createFromDto($deckDto);
        $ruleResponses = [];

        foreach ($deck->hands() as $hand) {
            $ruleResponses[] = $this->assignRankToHandService->runRulesValidation($hand);
        }


        $orderedHands = $this->orderHands($ruleResponses);

        //here order the orderedHands array based on the rank number (es el numero del indice)
        // create a deck based on these hands and create a dto from the deck and return it
        var_dump($orderedHands);
        die();
    }

    /**
     * @param RuleResponse[] $ruleResponses
     * @return Hand[]
     */
    private function orderHands(array $ruleResponses): array
    {
        $orderedHands = [];

        foreach ($ruleResponses as $ruleResponse) {
            $orderedHands[$ruleResponse->getRank()][] = $ruleResponse->getHand();
        }

        return $orderedHands;
    }
}
