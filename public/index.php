<?php
require '../vendor/autoload.php';  //pokud jedu přes composer
$f3 = \Base::instance();        //pokud jedu přes composer
$f3->config("../app/configs/config.ini");
$f3->set('DB', new \DB\SQL('mysql:host=localhost;dbname=skaut','root', ''));
$f3->run();


