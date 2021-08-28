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
        $dateTimeDifferenceLogic = $container->get(Logic\DateTimeDifferenceLogic::class);
        $dateTimeGeneratorLogic = $container->get(Logic\DateTimeGeneratorLogic::class);
        $passwordGeneratorLogic = $container->get(Logic\PasswordGeneratorLogic::class);
        return new $requestedName(
            $dateTimeDifferenceLogic,
            $dateTimeGeneratorLogic,
            $passwordGeneratorLogic
        );
    }
}
