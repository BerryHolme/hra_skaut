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
        $json_data = file_get_contents('php://input');
        $order = json_decode($json_data, true);

        if ($order !== null) {
            $products = $order['products'];
            $discount = $order['discount'];
            $totalPrice = $order['totalPrice'];
            $datetime = $order['datetime'];

            // Výpis produktů a jejich množství
            foreach ($products as $product) {
                echo "Produkt: " . $product['name'] . ", Množství: " . $product['quantity'] . "\n";
            }

            // Výpis dalších dat z objednávky
            echo "Sleva: $discount\n";
            echo "Celková cena: $totalPrice\n";
            echo "Čas objednávky: $datetime\n";

            $orders = new \models\orders();
            //$orders->chleba_s_klobaskami->$products[1]->["quantity"];


        } else {
            echo "Chyba při zpracování JSON dat.";
        }
    }



}
