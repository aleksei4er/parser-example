<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\String;

use Symfony\Component\String\UnicodeString;

final class UnicodeStringProxy
{
    /**
     * 
     * @param UnicodeString $string 
     * @return void 
     */
    public function __construct(private UnicodeString $string) {}

    /**
     * Proxy all methods to the UnicodeString
     *
     * @param string $name
     * @param array $args
     * @return mixed
     */
    public function __call(string $name, array $args): mixed
    {
        if (method_exists($this->string, $name)) {
            return $this->string->$name(...$args);
        }
    }
}
