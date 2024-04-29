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

    public function order(\Base $base)
    {
        $orders = new \models\orders();

        // Fetch all records from the database
        $result = $orders->find();
        $data = [];
        foreach ($result as $order) {
            $data[] = [
                'chleba' => $order->chleba,
                'klobasky' => $order->klobasky,
                'klobaska_v_rohliku' => $order->klobaska_v_rohliku,
                'pepsi' => $order->pepsi,
                'capri_sun' => $order->capri_sun,
                'sleva' => $order->sleva,
                'celkova_cena' => $order->celkova_cena,
                'cas_objednavky' => $order->cas_objednavky,
                'cas_dokonceni_objednavky' => $order->cas_dokonceni_objednavky,
                'dokonceno' => $order->dokonceno
            ];
        }
        header('Content-Type: application/json');
        // Return data as JSON
        echo json_encode($data);
    }



}
