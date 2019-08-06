<?php

declare(strict_types=1);

namespace Nemesi\Models;

class User extends \atk4\data\Model
{
    public $table = 'user';

    public function init(): void
    {
        parent::init();

        $this->addField('name', ['type' => 'string']);
        $this->addField('email', ['type' => 'email']);
        $this->addField('is_admin', ['type'=>'boolean']);
        $this->addField('password', [\atk4\login\Field\Password::class]);
    }
}
