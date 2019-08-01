<?php

declare(strict_types=1);

use Abbadon1334\ATKFastRoute\Handler\RoutedServeStatic;

return [
    [
        '/backend',
        ['GET', 'POST'],
        [\App\Backend\Main::class],
        function ($app, ...$parameters): void {
            $app->add(new \atk4\login\Auth())->setModel(new \Nemesi\Models\User($app->db));
        },
        function ($app, ...$parameters): void {
            echo 'AFTER';
        },
    ]
];
