<?php

declare(strict_types=1);

use Handrank\Adapters\Controllers\MainController;
use Handrank\Application\Services\AssignRankToHandService;
use Handrank\Application\Services\ReadFileService;
use Handrank\Application\Services\SortDeckService;

require "./vendor/autoload.php";

// The default file path is storage/input.txt
if (isset($argv[1]) === false) {
    echo "The program needs the file path to execute. Try with: php index.php storage/input.txt";
    die();
}

$filePath = $argv[1];

$sortDeckService = new SortDeckService(new AssignRankToHandService());

$mainController = new MainController
(
    readFileService: new ReadFileService($filePath),
    sortDeckService: $sortDeckService
);

$response = $mainController->sortHands();

if ($response->status() === 200) {
    echo "Initial deck\n";
    echo $response->initialDeck();
    echo "\nSorted deck\n";
    echo $response->sortedDeck();
} else {
    echo $response->status();
    echo $response->errorMessage();
}



