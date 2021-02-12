<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\HttpClient;

interface ClientServiceInterface
{
    public function request(...$args);
}
