<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

 $routes->get('/', 'Home::index');
 //$routes->get('/', 'AuthController::register');
 $routes->get('/register', 'AuthController::register');               // Affiche la page d'inscription
 $routes->post('/process_register', 'AuthController::process_register'); // Traite les données du formulaire d'inscription
 $routes->get('/login', 'AuthController::login');                   // Affiche la page de connexion
 $routes->post('/process_login', 'AuthController::process_login');    // Traite les données du formulaire de login
 $routes->get('/logout', 'AuthController::logout');
