<?php

namespace models;

use DB\Cortex;

class orders extends Cortex
{
    protected
        $db = 'DB',
        $table = 'orders';
    protected $fieldConf=[
        'chleba'=>[
            'type'=>'INT8',
            'nullable'=>false,
            'default'=>0
        ],
        'klobasky'=>[
            'type'=>'INT8',
            'nullable'=>false,
            'default'=>0
        ],
        'klobaska_v_rohliku'=>[
            'type'=>'INT8',
            'nullable'=>false,
            'default'=>0
        ],
        'pepsi'=>[
            'type'=>'INT8',
            'nullable'=>false,
            'default'=>0
        ],
        'capri_sun'=>[
            'type'=>'INT8',
            'nullable'=>false,
            'default'=>0
        ],
        'sleva'=>[
            'type'=>'INT8',
            'nullable'=>false,
            'default'=>0
        ],
        'celkova_cena'=>[
            'type'=>'INT8',
            'nullable'=>false,
            'default'=>0
        ],
        'cas_objednavky'=>[
            'type'=>'DATETIME',
            'nullable'=>false
        ],
        'cas_dokonceni_objednavky'=>[
            'type'=>'DATETIME',
            'nullable'=>true
        ],
        'dokonceno'=>[
            'type'=>'BOOLEAN',
            'nullable'=>false,
            'default'=>false
        ]
    ];
}
