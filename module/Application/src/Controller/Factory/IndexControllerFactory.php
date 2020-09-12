<?php

namespace Application\Controller\Factory;

use Interop\Container\ContainerInterface;
use Laminas\Mvc\I18n\Translator;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Domain\Service;

class IndexControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, $options = null)
    {
        $options = $options ?: null;
        $translator = $container->get(Translator::class);
        $service = $container->get(Service\IndexService::class);

        return new $requestedName(
            $translator,
            $service
        );
    }
}
