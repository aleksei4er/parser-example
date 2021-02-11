<?php

namespace App\Shared\Domain\CQRS;

interface CommandBusInterface {
    public function dispatch(CommandInterface $command): void;
}
