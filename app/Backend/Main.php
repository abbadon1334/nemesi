<?php

declare(strict_types=1);

namespace App\Backend;

use atk4\ui\Loader;
use atk4\ui\View;

class Main extends View
{
    public function init(): void
    {
        parent::init();

        $this->add('Header')->set('BE Main');

        $this->add($loader = new Loader());

        $loader->loadEvent =false;

        $loader->set(function($l) {

            $panel = $this->stickyGet('panel');

            switch($panel)
            {
                case 'load1':
                    $l->add( new View('loaded 1'));
                    break;

                case 'load2':
                    $l->add( new View('loaded 2'));
                    break;
            }
        });

        $this->add(['Button','loader 1'])->js('click', $loader->jsLoad(['panel' => 'load1']));

        $this->add(['Button','loader 2'])->js('click', $loader->jsLoad(['panel' => 'load2']));
    }
}
