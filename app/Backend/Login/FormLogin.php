<?php

declare(strict_types=1);

namespace App\Backend\Login;

use atk4\login\LoginForm;

class FormLogin extends LoginForm
{
    public function init(): void
    {
        // stuff above the form
        $c = $this->add('Columns');
        $c->addColumn(12)->add(['Header', 'Log into your account', 'size'=>2]);
        $c->addColumn(4)->add(['Button', 'Back', 'icon'=>'home', 'right floated tiny basic green'])
            ->link(['index']);
        $this->add(['ui'=>'hidden divider']);

        parent::init();

        // below the form - signup link
        $seg = $this->add(['ui'=>'secondary segment', 'class'=>['center aligned padded']]);
        $seg->add(['Text', 'Don\'t have account? &nbsp;&nbsp;']);
        $l = $seg->add([])->link(['register']);
        $l->add(['Text', 'Sign up']);
        $l->add(['Icon', 'angle right']);
    }
}
