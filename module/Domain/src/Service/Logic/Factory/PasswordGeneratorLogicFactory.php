<?php

namespace Domain\Service\Logic\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Domain\Service\Logic;

class PasswordGeneratorLogicFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $options = $options ?: null;
        $passwordLogic = $container->get(Logic\PasswordLogic::class);
        return new $requestedName($passwordLogic);
    }
}
