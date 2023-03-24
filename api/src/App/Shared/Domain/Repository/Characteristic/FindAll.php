<?php

declare(strict_types=1);

namespace App\Shared\Domain\Repository\Characteristic;

use App\Shared\Domain\Repository\FindAll as BaseFindAll;

/**
 * @template-extends BaseFindAll<\App\Shared\Domain\Entity\Characteristic>
 */
interface FindAll extends BaseFindAll
{
}
