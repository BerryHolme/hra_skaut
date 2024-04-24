<?php

namespace controllers;

class pruzkum
{
    public function index()
    {
        echo \Template::instance()->render("Z_Pruzkum.html");
    }

}