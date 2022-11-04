<?php

declare(strict_types=1);

namespace UI\Http\Rest\Controller\Product;

use App\Shared\Domain\Repository\Product\ProductRepository;
use App\Shared\Infrastructure\Serializer\ProductNormalizer;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Serializer;
use UI\Http\Rest\Response\OpenApi;

final class AllProductsAction
{
    private readonly Serializer $serializer;

    public function __construct(private readonly ProductRepository $repository)
    {
        $this->serializer = new Serializer([new ProductNormalizer()]);
    }

    /**
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
     */
    #[Route(path: '/products', methods: ['GET', 'HEAD'])]
    public function __invoke(): OpenApi
    {
        return OpenApi::fromPayload(
            $this->serializer->normalize($this->repository->all()),
            Response::HTTP_OK
        );
    }
}
