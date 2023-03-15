<?php

declare(strict_types=1);

namespace Handrank\Application\Domain;

class Card
{
    public function __construct(private readonly Number $number, private readonly Suite $suite)
    {
    }

    /**
     * @return Number
     */
    public function number(): Number
    {
        return $this->number;
    }

    /**
     * @return Suite
     */
    public function suite(): Suite
    {
        return $this->suite;
    }
}
