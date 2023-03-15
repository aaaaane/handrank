<?php

declare(strict_types=1);

namespace Handrank\Application\Domain;

class Number
{
    /** @const string */
    private const KING = 'K';
    /** @const string */
    private const ACE = 'A';
    /** @const string */
    private const JACK = 'J';
    /** @const string */
    private const QUEEN = 'Q';

    /**
     * @const array
     */
    private const RANKS_TO_NUMBER =
        [
            self::KING => 13,
            self::QUEEN => 12,
            self::JACK => 11,
            self::ACE => 1,
        ];

    /**
     * @const array
     */
    public const LIST =
        [
            self::JACK,
            self::QUEEN,
            self::KING,
            self::ACE,
            10,
            9,
            8,
            7,
            6,
            5,
            4,
            3,
            2,
        ];

    public function __construct(private readonly int|string $number)
    {
    }

    public function number(): int|string
    {
        return $this->number;
    }

    public function ranktoNumber(): int
    {
        if (gettype($this->number) !== 'integer') {
            return self::RANKS_TO_NUMBER[$this->number];
        }

        return $this->number;
    }
}
