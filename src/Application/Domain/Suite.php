<?php

declare(strict_types=1);

namespace Handrank\Application\Domain;

enum Suite: string
{
    case CLUBS = '♣';
    case DIAMONDS = '♦';
    case HEARTS = '♥';
    case SPADES = '♠';
}
