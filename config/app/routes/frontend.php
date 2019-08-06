<?php

declare(strict_types=1);

return [
    [
        '/[index]',
        ['GET', 'POST'],
        [\App\Frontend\Main::class],
        function ($app, ...$parameters): void {
        },
        function ($app, ...$parameters): void {
        },
    ],
];
