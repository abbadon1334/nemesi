<?php

declare(strict_types=1);

include __DIR__.'/../bootstrap.php';

$app = new Nemesi\Nemesi();
$app->configApp('config/app', \Nemesi\NemesiConfigurator::FORMAT_YAML);
$app->configRoutes('config/app/routes', \Nemesi\NemesiConfigurator::FORMAT_PHP_INLINE);
$app->run();
