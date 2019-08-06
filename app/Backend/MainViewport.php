<?php

declare(strict_types=1);

namespace App\Backend;

use atk4\login\Auth;
use atk4\ui\App;
use atk4\ui\Menu;
use Nemesi\Models\User;

class MainViewport
{
    public static function needAuth(App $app): void
    {
        //$app->add(new Auth())->setModel(new User($app->db));
    }

    public static function setHorizontalMenu(App $app): void
    {
        $menu = new Menu('test');
        $app->add($menu);
    }
}
