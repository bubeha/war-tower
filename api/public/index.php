<?php

declare(strict_types=1);

use App\Kernel;

require_once dirname(__DIR__) . '/vendor/autoload_runtime.php';
require_once dirname(__DIR__) . '/config/bootstrap.php';

/**
 * @param array{APP_ENV: string, APP_DEBUG: int} $context
 */
return static fn (array $context) => new Kernel((string)$context['APP_ENV'], (bool)$context['APP_DEBUG']);
