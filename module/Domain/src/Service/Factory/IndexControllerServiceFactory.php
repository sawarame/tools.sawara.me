<?php

namespace Domain\Service\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Domain\Service\Logic;

class IndexControllerServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $options = $options ?: null;
        $dateTimeLogic = $container->get(Logic\DateTimeGeneratorLogic::class);
        $passwordLogic = $container->get(Logic\PasswordGeneratorLogic::class);
        return new $requestedName(
            $dateTimeLogic,
            $passwordLogic
        );
    }
}
