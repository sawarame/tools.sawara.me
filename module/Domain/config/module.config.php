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
            Service\IndexControllerService::class => Service\Factory\IndexControllerServiceFactory::class,
            Service\Logic\DateTimeGeneratorLogic::class => Service\Logic\Factory\DateTimeGeneratorLogicFactory::class,
            Service\Logic\DateTimeLogic::class => InvokableFactory::class,
            Service\Logic\PasswordGeneratorLogic::class => Service\Logic\Factory\PasswordGeneratorLogicFactory::class,
            Service\Logic\PasswordLogic::class => InvokableFactory::class,
        ]
    ],
];
