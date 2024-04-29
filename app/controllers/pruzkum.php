<?php

namespace controllers;

class pruzkum
{
    public function index(\Base $base)
    {
        // Corrected condition check
        if ($base->get("SESSION.user[state]")) {
            echo \Template::instance()->render("Z_Pruzkum_Dekujeme.html");
        } else {
            echo \Template::instance()->render("Z_Pruzkum.html");
        }
    }

    public function postForm(\Base $base)
    {
        $klobasky = $base->get("POST.klobasky");
        // Corrected condition check
        if ($base->get("SESSION.user[state]")) {
            echo \Template::instance()->render("Z_Pruzkum_Dekujeme.html");
        } else {
            if ($klobasky > 9 or $klobasky < 1) {
                echo "Můžes mít pouze 1 až 9 klobásek!";
                return;
            } else {
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
        $json = json_decode($base->get('BODY'), true);

        $order = new \models\orders();

        // Mapping data from JSON to model
        foreach ($json['orderItems'] as $item) {
            switch ($item['name']) {
                case 'Chleba s klobáskami':
                    $order->chleba = $item['quantities'][0];
                    $order->klobasky = $item['quantities'][1];
                    break;
                case 'Klobáska v rohlíku':
                    $order->klobaska_v_rohliku = $item['quantities'][0];
                    break;
                case 'Pepsi':
                    $order->pepsi = $item['quantities'][0];
                    break;
                case 'CapriSun':
                    $order->capri_sun = $item['quantities'][0];
                    break;
            }
        }

        $order->sleva = $json['discount'];
        $order->celkova_cena = $json['totalPrice'];
        $order->cas_objednavky = date('Y-m-d H:i:s'); // Nastavení aktuálního času objednávky
        $order->dokonceno = false; // Inicializace stavu dokončení objednávky

        $order->save(); // Uložení dat do databáze

        // Redirect nebo výstup
        $base->reroute('/'); // Přesměrování uživatele po úspěšném uložení
    }

    public function orderes(\Base $base)
    {
        echo \Template::instance()->render("orders.html");
    }

    public function getOrders(\Base $base)
    {
        $db = $base->get('DB');  // Předpokládáme, že databázové spojení je uloženo v proměnné hive
        $result = $db->exec('SELECT * FROM orders WHERE dokonceno = 0 ORDER BY cas_objednavky ASC');

        echo json_encode($result);  // Vrácení výsledků v JSON formátu

    }

    public function complete(\Base $base)
    {
        $db = $base->get('DB');
        $orderId = $base->get('POST.id');  // Získání ID objednávky z POST data

        if (!empty($orderId)) {
            $db->exec('UPDATE orders SET dokonceno = 1, cas_dokonceni_objednavky = NOW() WHERE id = ?', $orderId);
            echo json_encode(['success' => true, 'message' => 'Objednávka byla označena jako dokončená.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Není zadáno ID objednávky.']);
        }

    }


}
