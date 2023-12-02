<?php

namespace controllers;

class admin
{
    public function getRegistrace(\Base $base)
    {
        $role = new \models\Role();
        $base->set('role',$role->find());
        $base->set('pozice',$base->get('SESSION.user.role'));
        $base->set("tlacitko","Registrovat");
        $base->set("content","prihlasit.html");
        echo \Template::instance()->render("layout.html");
        //echo \Template::instance()->render("index.html");
    }

    public function postRegistrace(\Base $base){
        $user = new \models\User();
        $user->copyfrom($base->get('POST'));
        $user->save();
        $base->reroute("/");
    }


}