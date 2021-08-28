<?php

namespace Domain\Service\Logic\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Domain\Service\Logic;

class DateTimeDifferenceLogicFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $options = $options ?: null;
        $dateTimeGeneratorLogic = $container->get(Logic\DateTimeGeneratorLogic::class);
        return new $requestedName($dateTimeGeneratorLogic);
    }
}
