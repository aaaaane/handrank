<?php

declare(strict_types=1);


use Handrank\Application\Dto\DeckDto;
use Handrank\Application\Services\AssignRankToHandService;
use Handrank\Application\Services\SortDeckService;
use PHPUnit\Framework\TestCase;

class SortDeckServiceTest extends TestCase
{

    /** @test */
    public function sortDeck()
    {
        $contentFromFile = '10♥ J♦ Q♠ K♣ A♦' . PHP_EOL . '10♥ J♦ Q♠ K♣ A♦' . PHP_EOL . '10♥ 10♦ 10♠ 9♣ 9♦' . PHP_EOL . '4♠ J♠ 8♠ 2♠ 9♠' . PHP_EOL . '3♦ J♣ 8♠ 4♥ 2♠';
        $deckDto = DeckDto::createFromString($contentFromFile);
        $sortDeckService = new SortDeckService(new AssignRankToHandService());
        $sortDeckService->sortDeck($deckDto);
    }
}
