<?php

namespace models;

use DB\Cortex;

class pruzkumMD extends Cortex
{
    protected $db = 'DB';
    protected $table = 'pruzkumDB';

    protected $fieldConf = [
        'pocet' => [
            'type'=>'INT8'
        ]
    ];


}