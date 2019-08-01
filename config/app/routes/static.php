<?php

declare(strict_types=1);

use Abbadon1334\ATKFastRoute\Handler\RoutedServeStatic;

return [
    [
        '/test',
        ['GET'],
        [function (): void {
            echo 'content';
        }],
        function ($app, ...$parameters): void {
            echo 'BEFORE';
        },
        function ($app, ...$parameters): void {
            echo 'AFTER';
        },
    ],
    [
        '/',
        ['GET', 'POST'],
        [\App\Frontend\Main::class],
        function ($app, ...$parameters): void {
            $app->add(new \atk4\login\Auth())->setModel(new \Nemesi\Models\User($app->db));
        },
        function ($app, ...$parameters): void {
            echo 'AFTER';
        },
    ],
    [
        '/backend',
        ['GET', 'POST'],
        [\App\Backend\Main::class],
    ],
    [
        '/routed',
        ['GET', 'POST'],
        [\App\Test::class, 'routed'],
    ],
    [
        '/resource/themes/default/assets/fonts/{path:.+}',
        ['GET'],
        [
            RoutedServeStatic::class,
            [
                getcwd().'/public/assets',
                [
                    'woff',
                    'woff2',
                    'ttf',
                ],
            ],
        ],
    ],
    [
        '/routed_static',
        ['GET', 'POST'],
        [\App\Test::class, 'routed_static'],
    ],
    [
        '/resource/{path:.+}',
        ['GET'],
        [
            RoutedServeStatic::class,
            [
                getcwd().'/public/assets',
                [
                    'css',
                    'js',
                ],
            ],
        ],
    ],
    [
        '/debugbar/{path:.+}',
        ['GET'],
        [
            RoutedServeStatic::class,
            [
                getcwd().'/vendor/maximebf/debugbar/src/DebugBar/Resources',
                [
                    'css',
                    'js',
                    'woff',
                    'woff2',
                    'ttf',
                ],
            ],
        ],
    ],
];
