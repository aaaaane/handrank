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
            self::ACE => 1,
            self::KING => 13,
            self::QUEEN => 12,
            self::JACK => 11,
        ];

    /**
     * @const array
     */
    public const LIST =
        [
            self::ACE,
            self::KING,
            self::QUEEN,
            self::JACK,
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

    public static function ranktoNumber(string|int $rank): int
    {
        if (gettype($rank) !== 'integer') {
            return self::RANKS_TO_NUMBER[$rank];
        }

        return $rank;
    }
}
