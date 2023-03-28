<?php

declare(strict_types=1);

namespace App\Game\Domain\Repository\Unit;

use App\Shared\Domain\Repository\FindAll as BaseFindAll;

/**
 * @template-extends BaseFindAll<\App\Game\Domain\Entity\Unit\Unit>
 */
interface FindAll extends BaseFindAll
{
}
