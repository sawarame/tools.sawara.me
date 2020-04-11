<?php

namespace Application\Controller\Factory;

use Interop\Container\ContainerInterface;
use Laminas\Mvc\I18n\Translator;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Domain\Service;

class IndexControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $translator = $container->get(Translator::class);
        $dateTimeService = $container->get(Service\DateTimeService::class);
        $stringService = $container->get(Service\StringService::class);

        return new $requestedName(
            $translator,
            $dateTimeService,
            $stringService
        );
    }
}
