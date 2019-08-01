<?php

declare(strict_types=1);

namespace App\Frontend;

use atk4\ui\View;

class Main extends View
{
    public function init(): void
    {
        parent::init();
        $this->add('Header')->set('FE Main');
    }
}
