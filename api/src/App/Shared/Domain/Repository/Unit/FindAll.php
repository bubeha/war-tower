<?php

declare(strict_types=1);

namespace App\Shared\Domain\Repository\Unit;

use App\Shared\Domain\Repository\FindAll as BaseFindAll;

/**
 * @template-extends BaseFindAll<\App\Shared\Domain\Entity\Unit\Unit>
 */
interface FindAll extends BaseFindAll
{
}
