<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    public function index()
    {
        // Vérification de la session utilisateur
        if (!session()->get('user')) {
            return redirect()->to('/login')->with('error', 'Veuillez vous connecter.');
        }

        return view('dashboard');
    }
}
