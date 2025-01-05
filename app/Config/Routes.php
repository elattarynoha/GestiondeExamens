<?php

use CodeIgniter\Router\RouteCollection;
use CodeIgniter\Config\Services; // Assure-toi que cette ligne est incluse

/**
 * @var RouteCollection $routes
 */

$routes = Services::routes();

$routes->get('/', 'AuthentifController::register'); // Route par défaut
$routes->get('/register', 'AuthentifController::register'); // Route pour /register

return $routes;
