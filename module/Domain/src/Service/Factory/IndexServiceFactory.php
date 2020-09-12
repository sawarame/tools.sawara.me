<?php

namespace Domain\Service\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Domain\Service\Logic;

class IndexServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $options = $options ?: null;
        $dateTimeLogic = $container->get(Logic\DateTimeLogic::class);
        $passwordLogic = $container->get(Logic\PasswordLogic::class);
        return new $requestedName(
            $dateTimeLogic,
            $passwordLogic
        );
    }
}
