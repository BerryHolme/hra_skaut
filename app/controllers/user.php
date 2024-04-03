<?php

namespace controllers;

class user
{
    public function uvod(\Base $base)
    {
        if($base->get("SESSION.user")) {
            $odpovedi = new \models\Odpovedi();
            $base->set("otazky", $odpovedi->find());
            $base->set("content", "U_menu.html");
            echo \Template::instance()->render("layout.html");
        }else{
            $base->reroute("/");
        }
    }

    public function getformular(\Base $base)
    {
        if($base->get("SESSION.user")){
            $users = new \models\User();
            $otazka = $base->get("PARAMS.id");
            $promena = "otazka" . strval($otazka);

            $user = $users->findone(["id=?", $base->get('SESSION.user.id')]);

            // Přidání kontroly, zda $user je skutečně objekt
            if($user && is_object($user) && $user->$promena == "1") {
                $odpovedi = new \models\Odpovedi();
                $odpoved = $odpovedi->findone(["id=?", $otazka]);
                $base->set("odpoved", $odpoved->odpovezeno);
                $base->set("hotovo", "true");
                $base->set("tlacitko", "zpět");
                $base->set("spatne", " ");
                $base->set("content", "U_formular.html");
            } else {
                $base->set("tlacitko", "Odeslat");
                $base->set("hotovo", "false");
                $base->set("spatne", " ");
                $base->set("content", "U_formular.html");
            }

            echo \Template::instance()->render("layout.html");
        } else{
            $base->reroute("/");
        }
    }

    public function postformular(\Base $base)
    {
        if($base->get("SESSION.user")){


        $users = new \models\User();
        $otazka = $base->get("PARAMS.id");
        $promena = "otazka". strval($otazka)  ;

        $user = $users->findone(["id=?",$base->get('SESSION.user.id')]);

        if($user && is_object($user) && $user->$promena == "1"){
            $base->reroute("/uvod");
        }else{

            $odpovedi= new \models\Odpovedi();
            $odpoved = $odpovedi->findone(["id=?",$otazka]);

            if($base->get("POST.odpoved")==$odpoved->odpoved){
                echo "hotovo";
                $user->$promena = 1;
                $user->save();

                $base->reroute();
            }else{
                $base->reroute();
            }

        }


        }else{
            $base->reroute("/");
        }



    }



}

/*
 * $odpovedi = new \models\Odpovedi();
            $odpoved = $odpovedi->findone(["id=?",$base->get('SESSION.user.id')]);
            $base->set("odpoved",$odpoved->odpoved);
            $base->set("hotovo","true");
            $base->set("tlacitko","zpět");
            $base->set("content","U_formular.html");
 */