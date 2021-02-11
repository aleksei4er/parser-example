<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Messenger;

use App\Shared\Domain\CQRS\CommandInterface;
use App\Shared\Domain\CQRS\CommandBusInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final class MessengerCommandBus implements CommandBusInterface
{
    private MessageBusInterface $commandBus;

    /**
     * 
     * @param MessageBusInterface $commandBus 
     * @return void 
     */
    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * 
     * @param CommandInterface $command 
     * @return void 
     */
    public function dispatch(CommandInterface $command): void
    {
        $this->commandBus->dispatch($command);
    }
}
