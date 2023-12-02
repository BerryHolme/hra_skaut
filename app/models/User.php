<?php

namespace models;

use DB\Cortex;

class User extends Cortex
{
    protected
        $db = 'DB',     // F3 hive key of a valid DB object
        $table = 'user';   // the DB table to work on
    protected $fieldConf=[
        'name'=>[
            'type'=>'VARCHAR256',
            'nullable'=>false
        ],
        'password'=>[
            'type'=>'VARCHAR256',
            'nullable'=>false
        ],
        'email'=>[
            'type'=>'VARCHAR256',
            'nullable'=>false,
            'index' => true,
            'unique' => true,
            'default' => ''
        ],
        'role'=>[
            'belongs-to-one'=>'\models\Role',
            'default'=>3
        ],
        'otazka1'=>[
            'type'=>'VARCHAR256',
            'nullable'=>false
        ],
        'otazka2'=>[
            'type'=>'VARCHAR256',
            'nullable'=>false
        ],
        'otazka3'=>[
            'type'=>'VARCHAR256',
            'nullable'=>false
        ],
        'otazka4'=>[
            'type'=>'VARCHAR256',
            'nullable'=>false
        ],
        'otazka5'=>[
            'type'=>'VARCHAR256',
            'nullable'=>false
        ],
        'otazka6'=>[
            'type'=>'VARCHAR256',
            'nullable'=>false
        ],
        'otazka7'=>[
            'type'=>'VARCHAR256',
            'nullable'=>false
        ],
        'otazka8'=>[
            'type'=>'VARCHAR256',
            'nullable'=>false
        ],
        'otazka9'=>[
            'type'=>'VARCHAR256',
            'nullable'=>false
        ],
        'otazka10'=>[
            'type'=>'VARCHAR256',
            'nullable'=>false
        ]


    ];

    protected function set_password($value)
    {
        return password_hash($value,PASSWORD_DEFAULT);
    }
}