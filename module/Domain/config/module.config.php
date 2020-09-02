<?php

/**
 * @see       https://github.com/laminas/laminas-mvc-skeleton for the canonical source repository
 * @copyright https://github.com/laminas/laminas-mvc-skeleton/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-mvc-skeleton/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Domain;

use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'service_manager' => [
        'factories' => [
            Service\IndexService::class => Service\Factory\IndexServiceFactory::class,
            Service\Logic\DateTimeLogic::class => Service\Logic\DateTimeLogicFactory::class,
            Service\Logic\dateTimeUtilLogic::class => InvokableFactory::class,
            Service\Logic\StringLogic::class => InvokableFactory::class,
        ]
    ],
];
