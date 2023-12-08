<?php

namespace controllers;

class uvodni
{
    public function uvod(\Base $base)
    {
        $role = $base->get('SESSION.user.role');
        if($role==1){
            $base->reroute("/admin/menu");
        }elseif ($base->get("SESSION.user")){
            $base->reroute("/uvod");
        }else {
            $base->reroute("/prihlasit");
        }

    }

    public function getprihlasit(\Base $base)
    {
        $role = new \models\Role();
        $base->set('role',$role->find());
        $base->set("tlacitko","Přihlásit");
        $base->set('pozice',$base->get('SESSION.user.role'));
        $base->set("content","prihlasit.html");

        echo \Template::instance()->render("layout.html");
    }

    public function postprihlasit(\Base $base){
        $email = $base->get("POST.email");
        $user = new \models\User();
        $base->clear("SESSION.user");
        $u = $user->findone(["email=?",$email]);
        if(password_verify($base->get("POST.password"),$u->password)){
            $base->set("SESSION.user[id]",$u->id);
            $base->set("SESSION.user[name]",$u->name);
            $base->set("SESSION.user[email]",$u->email);
            $base->set("SESSION.user[role]",$u->role->id);
            $base->reroute("/");
        }
        $base->reroute("/prihlasit");
    }

    public function extra_prihlasit(\Base $base)
    {
        //GET /extern/@user/@id/@email/@role = \controllers\uvodni->extra_prihlasit
        $user = new \models\User();
        $u = $user->findone(["id=?",$base->get("PARAMS.id")]);

        if($u->email==$base->get("PARAMS.email")) {
            $base->set("SESSION.user[id]", $u->id);
            $base->set("SESSION.user[name]", $u->name);
            $base->set("SESSION.user[email]", $u->email);
            $base->set("SESSION.user[role]", $u->role->id);
        }
        $base->reroute("/");

    }

}