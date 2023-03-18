<?php

declare(strict_types=1);

namespace Handrank\Application\Domain;

use Handrank\Application\Dto\DeckDto;

class Deck
{
    /**
     * @param Hand[] $hands
     */
    public function __construct(private readonly array $hands = [])
    {
    }

    public function hands(): array
    {
        return $this->hands;
    }

    public static function createFromDto(DeckDto $deckDto)
    {
        $hands = [];

        foreach ($deckDto->deck() as $handDto) {
            $cards = [];

            foreach ($handDto as $cardDto) {
                switch ($cardDto[DeckDto::SUITE]) {
                    case Suite::CLUBS->value:
                        $suite = Suite::CLUBS;
                        break;

                    case Suite::DIAMONDS->value:
                        $suite = Suite::DIAMONDS;
                        break;

                    case Suite::HEARTS->value:
                        $suite = Suite::HEARTS;
                        break;

                    case Suite::SPADES->value:
                        $suite = Suite::SPADES;
                        break;
                }
                $cards[] = new Card(number: new Number($cardDto[DeckDto::NUMBER]), suite: $suite);

            }

            $hands[] = new Hand($cards);
        }


        return new self($hands);
    }
}
