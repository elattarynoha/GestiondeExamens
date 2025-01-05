<?php
namespace App\Controllers;

class AuthentifController extends BaseController{

    public function register(){
        //Affichage de la page : REGISTER
        return view('register');
    }
    public function login(){
        //Affichage de la page : LOGIN
        return view('login');
    }
}