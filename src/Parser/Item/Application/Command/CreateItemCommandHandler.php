<?php

namespace App\Parser\Item\Application\Command;

use App\Parser\Item\Domain\Repository\ItemRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class CreateItemCommandHandler implements MessageHandlerInterface
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
