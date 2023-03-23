<?php

declare(strict_types=1);

namespace UI\Http\Rest\Controller;

use App\Shared\Infrastructure\Persistence\ReadModel\Unit\GetAllUnits;
use Symfony\Component\Routing\Annotation\Route;
use UI\Http\Rest\Response\OpenApi;

final class AllUnitsController
{
    #[Route('/units', name: 'all_units')]
    public function __invoke(GetAllUnits $repository): OpenApi
    {
        return OpenApi::fromPayload($repository->all(), 200);
    }
}
