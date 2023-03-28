<?php

declare(strict_types=1);

namespace App\Game\Domain\Repository\Characteristic;

use App\Shared\Domain\Repository\FindAll as BaseFindAll;

/**
 * @template-extends BaseFindAll<\App\Game\Domain\Entity\Characteristic>
 */
interface FindAll extends BaseFindAll
{
}
