<?php

namespace controllers;

class install
{

    private function addRole(){
        $mam = ["Administrátor","Hrač","Registrovaný"];
        foreach ($mam as $zaznam){
            $role = new \models\Role();
            $role->nazev = $zaznam;
            $role->save();
            unset($role);
        }
    }
    public function install(\Base $base){
        //\models\User::setdown();
        \models\User::setup();
        \models\Role::setdown();
        \models\Role::setup();
        \models\Odpovedi::setdown();
        \models\Odpovedi::setup();
        //\models\zpravy::setdown();
        //\models\zpravy::setup();
        $this->addRole();
    }
}