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
            'date-diff' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/date-diff',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'date_difference',
                    ],
                ],
            ],
            'password' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/password',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'password',
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
        'locale' => 'ja',
        //'locale' => 'en',
        'translation_files' => [
            [
                'type' => 'phparray',
                'filename' =>
                    __DIR__ . '/../../../vendor/laminas/laminas-i18n-resources/languages/ja/Laminas_Validate.php',
                'text_domain' => 'default',
                'locale' => 'ja',
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
            'layout/layout'           => __DIR__ . '/../../../view/layout/layout.phtml',
            //'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../../../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../../../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../../../view',
        ],
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],
];
