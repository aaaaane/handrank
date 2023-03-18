<?php

declare(strict_types=1);

namespace Handrank\Adapters\Controllers;

use Exception;
use Handrank\Adapters\Controllers\Validators\ContentFromFileValidator;
use Handrank\Application\Dto\DeckDto;
use Handrank\Application\Services\ReadFileService;
use Handrank\Application\Services\SortDeckService;

class MainController
{

    public function __construct
    (
        private readonly ReadFileService $readFileService,
        private readonly SortDeckService $sortDeckService
    )
    {
    }

    public function sortHands(): Response
    {
        try {
            $content = $this->readFileService->getContentFromFile();
        } catch (Exception $exception) {
            return $this->createResponse(
                status: 500,
                errorMessage: $exception->getMessage()
            );
        }

        $validator = ContentFromFileValidator::create($content);

        if ($validator->hasError() === true) {
            return $this->createResponse(
                status: 400,
                errorMessage: implode(PHP_EOL, $validator->getError())
            );
        }

        $deckDto = DeckDto::createFromString($content);

        $sortedDeckDto = $this->sortDeckService->sortDeck($deckDto);

        return $this->createResponse(
            status: 200,
            initialDeck: $deckDto->__toString(),
            sortedDeck: $sortedDeckDto->__toString()
        );
    }


    private function createResponse
    (
        int     $status,
        ?string $initialDeck = null,
        ?string $sortedDeck = null,
        ?string $errorMessage = null
    ): Response
    {
        $response = new Response(status: $status);
        if ($status === 200 && $sortedDeck !== null) {
            $response->setData(initialDeck: $initialDeck, sortedDeck: $sortedDeck);
        }

        if ($status !== 200 && $errorMessage !== null) {
            $response->setErrorMessage($errorMessage);
        }

        if ($status === 200 && $errorMessage !== null) {
            $response->setStatus(500);
            $response->setErrorMessage($errorMessage);
        }

        return $response;
    }
}
