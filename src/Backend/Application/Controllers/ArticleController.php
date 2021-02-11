<?php

namespace App\Backend\Application\Controllers;

use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Backend\Application\DataTransformers\ItemDTO;
use App\Parser\Item\Domain\Repository\ItemRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(Request $request, ItemRepositoryInterface $repository, PaginatorInterface $paginator)
    {
        $paginator = $paginator->paginate(
            $repository->listing(),
            $request->query->getInt('page', 1), 10
        );

        return $this->render('Views/index.html.twig', [
            "pagination" => $paginator,
            "items" => ItemDTO::fromPaginator($paginator->getItems())
        ]);
    }

    #[Route('/article/{id}', name: 'view')]
    public function view(int $id, ItemRepositoryInterface $repository)
    {
        return $this->render('Views/view.html.twig', [
            "item" => ItemDTO::fromEntity($repository->find($id)),
        ]);
    }
}
