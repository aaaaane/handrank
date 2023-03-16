<?php

declare(strict_types=1);

namespace Handrank\Adapters\Controllers;

use Handrank\Adapters\Controllers\Validators\ContentFromFileValidator;
use Handrank\Application\Dto\DeckDto;
use Handrank\Application\Services\ReadFileService;
use Exception;
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

    public function sortHands()
    {
        try {
            $content = $this->readFileService->getContentFromFile();
        } catch (Exception $exception) {
            // return some message with the message of the exception
        }

        $validator = ContentFromFileValidator::create($content);

        if ($validator->hasError() === true) {
            // return the message of the error/s
        }

        $deckDto = DeckDto::createFromString($content);

        $sortedDeckDto = $this->sortDeckService->sortDeck($deckDto);

    }
}
