<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\HttpClient;

use App\Shared\Domain\CQRS\CommandInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

final class HttpClientService implements ClientServiceInterface
{
    /**
     * 
     * @param HttpClientInterface $commandBus 
     * @return void 
     */
    public function __construct(private HttpClientInterface $http) {}

    /**
     * 
     * @param mixed $args 
     * @return ResponseInterface 
     * @throws TransportExceptionInterface 
     */
    public function request(...$args): ResponseInterface
    {
        return $this->http->request(...$args);
    }
}
