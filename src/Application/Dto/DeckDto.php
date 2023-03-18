<?php

declare(strict_types=1);

namespace Handrank\Application\Dto;

use Handrank\App\Helpers\CardValuesHelper;
use Handrank\Application\Domain\Card;
use Handrank\Application\Domain\Deck;

class DeckDto extends CardValuesHelper
{
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

    public static function createFromDeck(Deck $deck): self
    {
        $deckDto = new self();

        $handForDto = [];
        foreach ($deck->hands() as $hand) {
            $handForDto[] = $deckDto->cardsToArray($hand->cards());
        }

        $deckDto->deck = $handForDto;

        return $deckDto;
    }

    /**
     * @param Card[] $cards
     */
    private function cardsToArray(array $cards): array
    {
        $cardsForDto = [];

        foreach ($cards as $card) {
            $cardForDto = [];
            $cardForDto[self::NUMBER] = $card->number()->number();
            $cardForDto[self::SUITE] = $card->suite()->value;

            $cardsForDto[] = $cardForDto;
        }

        return $cardsForDto;
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

    private function getCardsInHand(array $cards): array
    {
        $cardsInHand = [];

        foreach ($cards as $card) {
            $cardsInHand[] = $this->getCardsArrayFromString($card);
        }

        return $cardsInHand;
    }

    private function getCardsArrayFromString(string $cardRaw): array
    {
        return [
            self::NUMBER => $this->getNumbersForCard($cardRaw),
            self::SUITE => $this->getSuiteForCard($cardRaw),
        ];
    }

    /**
     * @return string[]
     */
    public function deck(): array
    {
        return $this->deck;
    }

    public function __toString(): string
    {
       $deckToString = '';
        foreach ($this->deck() as $hand) {
            $handToString = '';
            foreach ($hand as $card) {
                $handToString .= $card[self::NUMBER] . $card[self::SUITE] . ' ';
            }

            $deckToString .= $handToString . "\n";
        }

        return $deckToString;
    }
}
