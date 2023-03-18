<?php

declare(strict_types=1);

namespace Handrank\Tests\Application\Services;

use Handrank\Application\Dto\DeckDto;
use Handrank\Application\Services\AssignRankToHandService;
use Handrank\Application\Services\SortDeckService;
use PHPUnit\Framework\TestCase;

class SortDeckServiceTest extends TestCase
{

    /** @test */
    public function sortsDeck()
    {
        $contentFromFile = '10♥ J♦ Q♠ K♣ A♦' . PHP_EOL . // Rank 1 - Royal Flush
            '4♣ 4♠ 3♣ 3♦ Q♣' . PHP_EOL . // Rank 8 - Two pair
            '10♥ 10♦ 10♠ 9♣ 9♦' . PHP_EOL . // Rank 4 - Full house
            '4♠ J♠ 8♠ 2♠ 9♠' . PHP_EOL . // Rank 5 - Flush
            '3♦ J♣ 8♠ 4♥ 2♠'; // Rank 10 - High Card

        $sortedContentFromFile = '10♥ J♦ Q♠ K♣ A♦' . PHP_EOL . // Rank 1 - Royal Flush
            '10♥ 10♦ 10♠ 9♣ 9♦' . PHP_EOL . // Rank 4 - Full house
            '4♠ J♠ 8♠ 2♠ 9♠' . PHP_EOL . // Rank 5 - Flush
            '4♣ 4♠ 3♣ 3♦ Q♣' . PHP_EOL . // Rank 8 - Two pair
            '3♦ J♣ 8♠ 4♥ 2♠'; // Rank 10 - High Card

        $deckDto = DeckDto::createFromString($contentFromFile);
        $sortedDtoFromContent = DeckDto::createFromString($sortedContentFromFile);
        $sortDeckService = new SortDeckService(new AssignRankToHandService());

        $sortedDeckDto = $sortDeckService->sortDeck($deckDto);

        $this->assertSame($sortedDtoFromContent->__toString(), $sortedDeckDto->__toString());
    }
}
