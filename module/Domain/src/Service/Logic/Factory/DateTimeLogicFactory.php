<?php

namespace Domain\Service\Logic\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Domain\Service\Logic;

class DateTimeLogicFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $options = $options ?: null;
        $dateTimeUtilLogic = $container->get(Logic\DateTimeUtilLogic::class);
        return new $requestedName($dateTimeUtilLogic);
    }
}
