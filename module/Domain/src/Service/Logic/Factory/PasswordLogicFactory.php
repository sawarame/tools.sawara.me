<?php

namespace Domain\Service\Logic\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Domain\Service\Logic;

class PasswordLogicFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $options = $options ?: null;
        $passwordUtilLogic = $container->get(Logic\PasswordUtilLogic::class);
        return new $requestedName($passwordUtilLogic);
    }
}
