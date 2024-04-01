<?php

namespace App\Controllers;

class Controller
{
    public function query()
    {
        return "<h1>Hello World from get Method in controller</h1>";
    }

    public function hello()
    {
        return "<h1>Showing Hello Endpoint.</h1>";
    }
}