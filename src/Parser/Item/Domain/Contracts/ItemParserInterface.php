<?php

namespace App\Parser\Item\Domain\Contracts;

interface ItemParserInterface
{
    public function __call(string $name, array $args);
}
