<?php

declare(strict_types=1);

namespace Handrank\Traits;

trait CanGetSuitesForCards
{

    private function getCardSuitesFromHand(string $hand): array
    {
        $arrayHand = explode(' ', $hand);
        $suites = [];

        foreach ($arrayHand as $card) {
            $suites[] = $this->getSuiteForCard($card);
        }

        return $suites;
    }

    /**
     * @param string $card
     * @return string
     */
    protected function getSuiteForCard(string $card): string
    {
        return mb_substr($card, -1, 1, 'utf-8');
    }
}
