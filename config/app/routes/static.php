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
        '/resource/themes/default/assets/fonts/{path:.+}',
        ['GET'],
        [
            RoutedServeStatic::class,
            [
                getcwd().'/public/assets/fonts',
                [
                    'woff',
                    'woff2',
                    'ttf',
                ],
            ],
        ],
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
