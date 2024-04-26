<?php

namespace controllers;

class pruzkum
{
    public function index(\Base $base)
    {
        // Corrected condition check
        if($base->get("SESSION.user[state]")){
            echo \Template::instance()->render("Z_Pruzkum_Dekujeme.html");
        }else{
            echo \Template::instance()->render("Z_Pruzkum.html");
        }
    }

    public function postForm(\Base $base)
    {
        $klobasky = $base->get("POST.klobasky");
        // Corrected condition check
        if($base->get("SESSION.user[state]")){
            echo \Template::instance()->render("Z_Pruzkum_Dekujeme.html");
        }else{
            if ($klobasky > 9 or $klobasky < 1){
                echo "Můžes mít pouze 1 až 9 klobásek!";
                return;
            }else{
                $databaze = new \models\pruzkumMD();
                // Assuming pocet is a properly defined property
                $databaze->pocet = $klobasky;
                $databaze->save();
                $base->set("SESSION.user[state]", true);
            }
        }
        $base->reroute("/");
    }

    public function cashier()
    {
        echo \Template::instance()->render("cashier.html");
    }
}
