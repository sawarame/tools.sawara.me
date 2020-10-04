<?php

namespace Application\Controller\Factory;

use Interop\Container\ContainerInterface;
use Laminas\Mvc\I18n\Translator;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Sawarame\Optional;
use Domain\Service;

class IndexControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, $options = null)
    {
        $options = $options ?: null;
        $translator = $container->get(Translator::class);
        $service = $container->get(Service\IndexService::class);

        $language = Optional::ofNullable(filter_input(INPUT_SERVER, 'HTTP_ACCEPT_LANGUAGE'))
            ->map(function ($locale) {
                return substr($locale, 0, 2);
            })
            ->orElse('ja');
        $translator->setLocale($language);

        return new $requestedName(
            $translator,
            $service
        );
    }
}
