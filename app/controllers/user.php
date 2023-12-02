<?php

namespace controllers;

class user
{
    public function uvod(\Base $base)
    {
        $base->set("content","U_menu.html");
        echo \Template::instance()->render("layout.html");
    }

    public function getformular(\Base $base)
    {
        $users = new \models\User();
        $otazka = $base->get("PARAMS.id");
        $promena = "otazka". strval($otazka)  ;

        $user = $users->findone(["id=?",$base->get('SESSION.user.id')]);
        if($user->$promena == "1"){
            $odpovedi = new \models\Odpovedi();
            $odpoved = $odpovedi->findone(["id=?",$base->get('SESSION.user.id')]);
            $base->set("odpoved",$odpoved->odpoved);
            $base->set("hotovo","true");
            $base->set("tlacitko","zpět");
            $base->set("content","U_formular.html");
        }else{
            $base->set("tlacitko","Odeslat");
            $base->set("hotovo","false");
            $base->set("content","U_formular.html");
        }


        //$u = $user->findone(["email=?",$email]);



        echo \Template::instance()->render("layout.html");
    }

    public function postformular(\Base $base)
    {

    }



}