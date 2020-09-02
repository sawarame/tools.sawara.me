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
        $stringLogic = $container->get(Logic\StringLogic::class);
        return new $requestedName(
            $dateTimeLogic,
            $stringLogic
        );
    }
}