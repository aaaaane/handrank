<?php

declare(strict_types=1);

namespace Handrank\Application\Dto;

class DeckDto
{
    /**
     * @param string[] $hands
     */
    public function __construct(protected array $hands)
    {
    }

    /**
     * @return string[]
     */
    public function hands(): array
    {
        return $this->hands;
    }

    public static function createFromString(string $content)
    {
        $hands = explode(PHP_EOL, $content);

        return new self($hands);
    }
}
