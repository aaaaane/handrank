<?php

declare(strict_types=1);

namespace Handrank\Adapters\Controllers;

use Handrank\Application\Services\ReadFileService;

class MainController
{
    public function __construct(private readonly ReadFileService $readFileService)
    {
    }

    public function sortHands()
    {

    }
}
