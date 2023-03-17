<?php

declare(strict_types=1);

use Handrank\Adapters\Controllers\MainController;
use Handrank\Application\Services\AssignRankToHandService;
use Handrank\Application\Services\ReadFileService;
use Handrank\Application\Services\SortDeckService;

require "./vendor/autoload.php";

$sortDeckService = new SortDeckService(new AssignRankToHandService());

$mainController = new MainController
(
    readFileService: new ReadFileService(),
    sortDeckService: $sortDeckService
);

$response = $mainController->sortHands();

if ($response->status() === 200) {
    echo '<b>Initial deck</b><br>';
    echo $response->initialDeck();
    echo '<br><b>Sorted deck</b><br>';
    echo $response->sortedDeck();
} else {
    echo $response->status();
    echo $response->errorMessage();
}



