<?php

namespace models;

use DB\Cortex;

class Odpovedi extends Cortex
{
    protected
        $db = 'DB',     // F3 hive key of a valid DB object
        $table = 'odpovedi';   // the DB table to work on
    protected $fieldConf=[
        'odpoved'=>[
            'type'=>'VARCHAR256',
            'nullable'=>false
        ],
        'odpovezeno'=>[
            'type'=>'VARCHAR256',
            'nullable'=>false
        ]
    ];


}