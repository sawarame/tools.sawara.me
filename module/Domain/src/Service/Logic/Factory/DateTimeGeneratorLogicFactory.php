<?php

namespace Domain\Service\Logic\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Domain\Service\Logic;

class DateTimeGeneratorLogicFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $options = $options ?: null;
        $dateTimeLogic = $container->get(Logic\DateTimeLogic::class);
        return new $requestedName($dateTimeLogic);
    }
}
