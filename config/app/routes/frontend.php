<?php

declare(strict_types=1);

use Abbadon1334\ATKFastRoute\Handler\RoutedServeStatic;

return [
    [
        '/',
        ['GET', 'POST'],
        [\App\Frontend\Main::class],
        function ($app, ...$parameters): void {},
        function ($app, ...$parameters): void {},
    ]
];
