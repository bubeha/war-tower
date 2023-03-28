<?php

declare(strict_types=1);

namespace App\Game\Domain\Repository\Recipe;

use App\Game\Domain\Repository\FindAll as BaseFindAll;

/**
 * @template-extends BaseFindAll<\App\Game\Domain\Entity\Recipe\Recipe>
 */
interface FindAll extends BaseFindAll
{
}
