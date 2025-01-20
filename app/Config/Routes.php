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

 // route pour afficher la table des étudiants avec leurs notes :
$routes->get('/load_table_etudiant', 'StudentController::load_table_etu');

// Traitement d'ajout de notes pour chaque étudiant selon le module associé :
$routes->post('/Add_note_student', 'StudentController::addNote');

// Traitement de modification de notes pour chaque étudiant selon le module associé :
$routes->post('/updateNote', 'StudentController::updateNote');


