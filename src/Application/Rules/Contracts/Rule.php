<?php

declare(strict_types=1);


namespace Handrank\Application\Rules\Contracts;

use Handrank\Application\Domain\Hand;
use Handrank\Application\Rules\RuleResponse;

interface Rule
{
    public function validate(Hand $hand): RuleResponse;
}
