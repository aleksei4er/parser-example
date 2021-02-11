<?php

namespace App\Parser\Item\Application\Command\Middlewares;

use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Middleware\StackInterface;
use App\Shared\Infrastructure\Messenger\MessengerMiddleware;
use App\Parser\Item\Domain\Repository\ItemRepositoryInterface;

class CheckUniqueMiddleware extends MessengerMiddleware
{
    public function __construct(private ItemRepositoryInterface $repository) {}

    public function handle(Envelope $envelope, StackInterface $stack): Envelope
    {
        if ($item = $this->repository->findByHref($envelope->getMessage()->getHref())) {
            throw new \Exception("Item already exists");
        }

        return $stack->next()->handle($envelope, $stack);
    }
}
