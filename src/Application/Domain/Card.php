<?php

declare(strict_types=1);

namespace Handrank\Application\Domain;

class Card
{
    public function __construct(private readonly Number $number, private readonly Suite $suite)
    {
    }

    /**
     * @return Number
     */
    public function number(): Number
    {
        return $this->number;
    }

    /**
     * @return Suite
     */
    public function suite(): Suite
    {
        return $this->suite;
    }

    /**
     * @param Card[] $cards
     * @return string[]
     */
    public static function getNumbersFromCards(array $cards): array
    {
        $numbers = [];

        foreach ($cards as $card) {
            $numbers[] = $card->number()->number();
        }

        return $numbers;
    }

    public static function getSuitesFromCards(array $cards): array
    {
        $suites = [];

        foreach ($cards as $card) {
            $suites[] = $card->suite()->value;
        }

        return $suites;
    }
}
