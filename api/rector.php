<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Php80\Rector\Class_\StringableForToStringRector;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;

return static function (RectorConfig $config): void {
    $config->parallel();
    $config->paths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);

    $config->cacheDirectory(__DIR__ . '/var/cache/rector');

    $config->sets([
        LevelSetList::UP_TO_PHP_81,
        SetList::DEAD_CODE,
    ]);

    $config->skip([
        StringableForToStringRector::class,
    ]);
};
