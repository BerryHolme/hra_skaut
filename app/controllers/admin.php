<?php

namespace controllers;

class admin
{

    public function menu(\Base $base)
    {
        if($base->get("SESSION.user.role")==1) {
            $base->set("content", "A_menu.html");
            echo \Template::instance()->render("layout.html");
        }else{
            $base->reroute("/");
        }
    }

    public function getRegistrace(\Base $base)
    {
        if($base->get("SESSION.user.role")==1) {
            $role = new \models\Role();
            $base->set('role', $role->find());
            $base->set('pozice', $base->get('SESSION.user.role'));
            $base->set("tlacitko", "Registrovat");
            $base->set("content", "prihlasit.html");
            echo \Template::instance()->render("layout.html");
            //echo \Template::instance()->render("index.html");
        }else{
            $base->reroute("/prihlasit");
        }
    }

    public function postRegistrace(\Base $base){
        if($base->get("SESSION.user.role")==1) {

            $user = new \models\User();
            $user->copyfrom($base->get('POST'));
            $user->save();
            $base->reroute("/admin/menu");
        }else{
            $base->reroute("/prihlasit");
        }

    }


    public function seznam_registrovanych(\Base $base)
    {
        if($base->get("SESSION.user.role")==1) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ%|#@{}[]Ł$';
            $randomString = '';

            for ($i = 0; $i < 5; $i++) {
                $randomString .= $characters[rand(0, strlen($characters) - 1)];
            }

            $user = new \models\User();
            $base->set('user',$user->find());
            $base->set('cislo',$randomString);
            $base->set("content", "A_seznam_reg.html");
            echo \Template::instance()->render("layout.html");
        }else{
            $base->reroute("/prihlasit");
        }


    }

    public function seznam_registrovanych_post(\Base $base)
    {
        if($base->get("SESSION.user.role")==1) {

            $user = new \models\User();
            $smazat = $user->findone(["id=?",$base->get("POST.id_user")]);
            $smazat ->erase();
            $base ->reroute("/admin/seznam_reg");


        }else{
            $base->reroute("/prihlasit");
        }
    }


    public function seznam_otazky(\Base $base)
    {
        if($base->get("SESSION.user.role")==1) {
            $user = new \models\User();
            $base->set('user',$user->find());
            $base->set("content", "A_seznam_odpov.html");
            echo \Template::instance()->render("layout.html");
        }else{
            $base->reroute("/prihlasit");
        }
    }

    public function get_odpoved(\Base $base)
    {
        if($base->get("SESSION.user.role")==1) {

            $base->set("content", "A_add_odpoved.html");
            echo \Template::instance()->render("layout.html");
        }else{
            $base->reroute("/prihlasit");
        }
    }

    public function post_odpoved(\Base $base)
    {
        if($base->get("SESSION.user.role")==1) {

            \models\Odpovedi::setdown();
            \models\Odpovedi::setup();

            for ($i = 1; $i <= 10; $i++) {
                $odpovedi = new \models\Odpovedi();
                $odpovedi->odpoved = $base->get("POST.odpoved" . $i);
                $odpovedi->odpovezeno = $base->get("POST.zprava" . $i);
                $odpovedi->save();
            }


            $userModel = new \models\User();
            $users = $userModel->find();
            foreach ($users as $row) {
                echo $row->otazka1;
                for ($i = 1; $i <= 10; $i++) {
                    $columnName = "otazka" . $i;
                    $row->$columnName = 0;
                }

                // Save changes to the database
                $row->save();
            }


            $base->reroute("/uvod");
        }else{
            $base->reroute("/prihlasit");
        }
    }



}