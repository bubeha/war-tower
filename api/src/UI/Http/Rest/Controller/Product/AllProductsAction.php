<?php

declare(strict_types=1);

namespace UI\Http\Rest\Controller\Product;

use App\Shared\Domain\Entity\Product\Product;
use App\Shared\Domain\Repository\Product\ProductRepository;
use App\Shared\Infrastructure\Persistence\ReadModel\Product\ProductView;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use UI\Http\Rest\Response\OpenApi;

use function array_map;

final class AllProductsAction
{
    public function __construct(private readonly ProductRepository $repository)
    {
    }

    #[Route(path: '/products', methods: ['GET', 'HEAD'])]
    public function __invoke(): OpenApi
    {
        $result = $this->repository->all();

        return OpenApi::fromPayload(array_map(static fn (Product $product) => ProductView::create($product->getId(), $product->getDetail(), $product->getCategory()), $result), Response::HTTP_OK);
    }
}
