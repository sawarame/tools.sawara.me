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
            Service\Logic\DateTimeLogic::class => Service\Logic\Factory\DateTimeLogicFactory::class,
            Service\Logic\DateTimeUtilLogic::class => InvokableFactory::class,
            Service\Logic\PasswordLogic::class => Service\Logic\Factory\PasswordLogicFactory::class,
            Service\Logic\PasswordUtilLogic::class => InvokableFactory::class,
        ]
    ],
];
