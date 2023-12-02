<?php

namespace models;

use DB\Cortex;

class Role extends Cortex
{
    protected $db = 'DB';
    protected $table = 'role';
    protected $primary = 'id';

    protected $fieldConf = [
        'nazev' => [
            'type'=>'VARCHAR256',
            'nullable'=>false
        ],
        'uzivatel'=>[
            'has-many'=>array('\models\User','role')
        ]
    ];
}