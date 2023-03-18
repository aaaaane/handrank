<?php

declare(strict_types=1);

namespace Handrank\Tests\Application\Services;

use Handrank\Application\Domain\Card;
use Handrank\Application\Domain\Hand;
use Handrank\Application\Domain\Number;
use Handrank\Application\Domain\Suite;
use Handrank\Application\Services\AssignRankToHandService;
use PHPUnit\Framework\TestCase;

class AssignRankToHandServiceTest extends TestCase
{
    /** @test */
    public function runsRulesValidation()
    {
        $hand = new Hand(
            [
                new Card(
                    new Number('J'),
                    Suite::CLUBS,
                ),
                new Card(
                    new Number('J'),
                    Suite::SPADES,
                ),
                new Card(
                    new Number(10),
                    Suite::CLUBS,
                ),
                new Card(
                    new Number(10),
                    Suite::CLUBS,
                ),
                new Card(
                    new Number(9),
                    Suite::CLUBS,
                ),
            ]);

        $assignRankToHandService = new AssignRankToHandService();
        $rulesValidationResponse = $assignRankToHandService->runRulesValidation($hand);

        $this->assertTrue($rulesValidationResponse->getMatches());
    }
}
