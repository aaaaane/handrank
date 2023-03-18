<?php

declare(strict_types=1);

namespace Handrank\Adapters\Controllers;

use stdClass;

class Response
{

    private ?object $data;

    public function __construct(
        private ?int    $status = 200,
        private ?string $errorMessage = null
    )
    {
    }


    public function initialDeck(): ?string
    {
        return $this->data->initial_deck;
    }

    public function sortedDeck(): ?string
    {
        return $this->data->sorted_deck;
    }


    public function status(): ?int
    {
        return $this->status;
    }

    public function errorMessage(): ?string
    {
        return $this->errorMessage;
    }

    public function setErrorMessage(string $errorMessage): void
    {
        $this->errorMessage = $errorMessage;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function setData(string $initialDeck, string $sortedDeck): void
    {
        $data = new stdClass();
        $data->initial_deck = $initialDeck;
        $data->sorted_deck = $sortedDeck;

        $this->data = $data;
    }
}
