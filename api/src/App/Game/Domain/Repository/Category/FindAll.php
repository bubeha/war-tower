<?php

declare(strict_types=1);

namespace App\Game\Domain\Repository\Category;

use App\Game\Domain\Repository\FindAll as BaseFindAll;

/**
 * @template-extends BaseFindAll<\App\Game\Domain\Entity\Category>
 */
interface FindAll extends BaseFindAll
{
}
