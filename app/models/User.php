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
            'nullable'=>false,
            'default'=>0
        ],
        'otazka2'=>[
            'type'=>'VARCHAR256',
            'nullable'=>false,
            'default'=>0
        ],
        'otazka3'=>[
            'type'=>'VARCHAR256',
            'nullable'=>false,
            'default'=>0
        ],
        'otazka4'=>[
            'type'=>'VARCHAR256',
            'nullable'=>false,
            'default'=>0
        ],
        'otazka5'=>[
            'type'=>'VARCHAR256',
            'nullable'=>false,
            'default'=>0
        ],
        'otazka6'=>[
            'type'=>'VARCHAR256',
            'nullable'=>false,
            'default'=>0
        ],
        'otazka7'=>[
            'type'=>'VARCHAR256',
            'nullable'=>false,
            'default'=>0
        ],
        'otazka8'=>[
            'type'=>'VARCHAR256',
            'nullable'=>false,
            'default'=>0
        ],
        'otazka9'=>[
            'type'=>'VARCHAR256',
            'nullable'=>false,
            'default'=>0
        ],
        'otazka10'=>[
            'type'=>'VARCHAR256',
            'nullable'=>false,
            'default'=>0
        ]


    ];

    protected function set_password($value)
    {
        return password_hash($value,PASSWORD_DEFAULT);
    }
}