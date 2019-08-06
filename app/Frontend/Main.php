<?php

declare(strict_types=1);

namespace App\Frontend;

use atk4\ui\View;
use Nemesi\Models\User;

class Main extends View
{
    public function init(): void
    {
        parent::init();
        $this->add('Header')->set('FE Main');
        $view = $this->add('View');
        $view->addClass('ui segment');
        $view->add('Form')->setModel(new User($this->app->db));
    }
}
