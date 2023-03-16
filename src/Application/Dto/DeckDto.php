<?php

declare(strict_types=1);

namespace Handrank\Application\Dto;

use Handrank\Traits\CanGetNumbersForCards;
use Handrank\Traits\CanGetSuitesForCards;

class DeckDto
{
    use CanGetNumbersForCards, CanGetSuitesForCards;

    /**
     * @const string
     */
    public const NUMBER = 'number';

    /**
     * @const string
     */
    public const SUITE = 'suite';
    protected array $deck;

    public function __construct()
    {
    }

    /**
     * @return string[]
     */
    public function deck(): array
    {
        return $this->deck;
    }

    public static function createFromString(string $content): self
    {
        $handsRaw = explode(PHP_EOL, $content);
        $deckDto = new self();
        $deck = [];

        foreach ($handsRaw as $handRaw) {
            $cardsRaw = explode(' ', $handRaw);

            $deck[] = $deckDto->getCardsInHand($cardsRaw);
        }

        $deckDto->deck = $deck;

        return $deckDto;
    }

    private function getCardsArrayFromString(string $cardRaw): array
    {
        return [
            self::NUMBER => $this->getNumbersForCard($cardRaw),
            self::SUITE => $this->getSuiteForCard($cardRaw),
        ];
    }

    private function getCardsInHand(array $cards): array
    {
        $cardsInHand = [];

        foreach ($cards as $card) {
            $cardsInHand[] = $this->getCardsArrayFromString($card);
        }

        return $cardsInHand;
    }
}
