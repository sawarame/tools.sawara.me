<?php

namespace Application\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Domain\Service;

class IndexControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $dateTimeService = $container->get(Service\DateTimeService::class);

        return new $requestedName(
            $dateTimeService
        );
    }
}
