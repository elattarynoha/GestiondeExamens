<?php

namespace App\Controllers;

class Register extends BaseController
{
    public function index()
    {
        return view('login'); // Charge la vue 'register.php'
}
}