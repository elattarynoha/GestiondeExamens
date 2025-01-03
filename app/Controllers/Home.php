<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // Charger la vue home.php qui contient le code HTML de ta template
        return view('home');
    }
}
