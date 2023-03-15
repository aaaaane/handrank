<?php

declare(strict_types=1);

namespace Handrank\Application\Domain;

class Hand
{
    /**
     * @param Card[] $cards
     */
    public function __construct(private readonly array $cards)
    {
    }


    public function cards(): array
    {
        return $this->cards;
    }
}
