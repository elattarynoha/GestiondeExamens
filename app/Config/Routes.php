<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
   // Les routes pour le processus d'authentification:
 $routes->get('/', 'AuthentifController::register');
 $routes->get('/register', 'AuthentifController::register');               // Affiche la page d'inscription
 $routes->post('/SignUp_Process', 'AuthentifController::SignUp_Process'); // Traite les données du formulaire d'inscription
 $routes->get('/login', 'AuthentifController::login');                   // Affiche la page de connexion
 $routes->post('/SignIn_Process', 'AuthentifController::SignIn_Process');    // Traite les données du formulaire de login

 // Les routes pour le processus d'authentification:
 $routes->get('/StudentDashboard','StudentDashboard_Controller::StudentDashboard');
 $routes->get('/ProfDashboard','ProfDashboard_Controller::ProfDashboard');
 
 // La route pour se déconnecter
 $routes->get('/logout', 'AuthentifController::logout');
 // route pour afficher les modules :
$routes->get('/Modules', 'ModuleController::showModules');  


$routes->get('/load_table_etu', 'ModuleController::load_table_etu');


