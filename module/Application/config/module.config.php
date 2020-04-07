<?php

/**
 * @see       https://github.com/laminas/laminas-mvc-skeleton for the canonical source repository
 * @copyright https://github.com/laminas/laminas-mvc-skeleton/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-mvc-skeleton/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Application;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'application' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/application[/:action]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'date' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/date',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'date',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => Controller\Factory\IndexControllerFactory::class,
        ],
    ],
    'translator' => [
        'locale' => 'ja_JP',
        //'locale' => 'en_US',
        'translation_files' => [
            [
                'type' => 'phparray',
                'filename' => __DIR__ . '/../../../vendor/laminas/laminas-i18n-resources/languages/ja/Laminas_Validate.php',
                'text_domain' => 'default',
                'locale' => 'ja_JP',
            ],
            [
                'type' => 'phparray',
                'filename' => __DIR__ . '/../languages/date/ja_JP.php',
                'text_domain' => 'date',
                'locale' => 'ja_JP',
            ],
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            //'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'view_helpers' => [
        'factories' => [
            View\Helper\Bs4FormElement::class => InvokableFactory::class,
            View\Helper\Bs4FormElementErrors::class => InvokableFactory::class,
        ],
        'aliases' => [
            'bs4FormElement' => View\Helper\Bs4FormElement::class,
            'Bs4FormElement' => View\Helper\Bs4FormElement::class,
            'bs4FormElementErrors' => View\Helper\Bs4FormElementErrors::class,
            'Bs4FormElementErrors' => View\Helper\Bs4FormElementErrors::class,
        ],
    ],
];
