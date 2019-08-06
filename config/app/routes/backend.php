<?php

declare(strict_types=1);

return [
    [
        '/backend',
        ['GET', 'POST'],
        [\App\Backend\Main::class],
        function ($app, ...$parameters): void {
            \App\Backend\MainViewport::needAuth($app);
            \App\Backend\MainViewport::setHorizontalMenu($app);
        },
        function ($app, ...$parameters): void {
            //echo 'AFTER';
        },
    ],
];
