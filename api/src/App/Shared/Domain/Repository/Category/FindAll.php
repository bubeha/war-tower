<?php

declare(strict_types=1);

namespace App\Shared\Domain\Repository\Category;


use App\Shared\Domain\Repository\FindAll as BaseFindAll;

/**
 * @template-extends BaseFindAll<\App\Shared\Domain\Entity\Category>
 */
interface FindAll extends BaseFindAll
{

}
