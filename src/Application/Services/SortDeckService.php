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

        $orderedHandsResponse = $this->orderHands($ruleResponses);
        ksort($orderedHandsResponse);
        $orderedHands = $this->assembleHands($orderedHandsResponse);

        $orderedDeck = new Deck($orderedHands);

        return DeckDto::createFromDeck($orderedDeck);
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

    private function assembleHands(array $orderedHands): array
    {
        $sortedHands = [];
        foreach ($orderedHands as $hands) {
            foreach ($hands as $hand) {
                $sortedHands[] = $hand;
            }
        }

        return $sortedHands;
    }
}
