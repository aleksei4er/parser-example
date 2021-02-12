<?php

namespace App\Parser\Item\Application\Command;

use App\Parser\Item\Domain\Repository\ItemRepositoryInterface;
use App\Shared\Infrastructure\Messenger\MessengerHandler;

final class CreateItemCommandHandler extends MessengerHandler
{
    /**
     * 
     * @param ItemRepositoryInterface $repository 
     * @return void 
     */
     public function __construct(private ItemRepositoryInterface $repository)
     {
         $this->repository  = $repository;
     }

    public function __invoke(CreateItemCommand $createItemCommand)
    {
        $this->repository->create(
            $createItemCommand->getSite(),
            $createItemCommand->getHref(),
            $createItemCommand->getData(),
        );
    }
}
