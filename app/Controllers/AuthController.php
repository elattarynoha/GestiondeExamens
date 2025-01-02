<?php
namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    // Afficher le formulaire d'inscription
    public function register()
    {
        return view('register');
    }

    // Traitement d'inscription
    public function process_register()
    {
        $model = new UserModel();

        // Récupération des données du formulaire d'inscription
        $data_register = [
            'UserName' => $this->request->getPost('Username'),
            'Email' => $this->request->getPost('Email'),
            'Password' => password_hash($this->request->getPost('Password'), PASSWORD_DEFAULT),
        ];

        // Validation des données (par exemple, vérifier si les champs sont vides)
        if (empty($data_register['UserName']) || empty($data_register['Email']) || empty($data_register['Password'])) {
            return redirect()->back()->with('error', 'Tous les champs sont obligatoires.');
        }

        // Vérifier si l'email est déjà utilisé
        if ($model->where('Email', $data_register['Email'])->first()) {
            return redirect()->back()->with('error', 'Cet email est déjà utilisé.');
        }

        // Insérer l'utilisateur dans la base de données
        if ($model->insert($data_register)) {
            // Rediriger vers la page de connexion avec un message de succès
            return redirect()->to('/login')->with('success', 'Inscription réussie !');
        } //else {
            // Si l'insertion échoue, rediriger avec un message d'erreur
            //return redirect()->back()->with('error', 'Une erreur est survenue, veuillez réessayer.');
        //}
    }

    // Afficher le formulaire de connexion
    public function login()
    {
        return view('login');
    }

    // Traitement de connexion
    public function process_login()
    {
        $model = new UserModel();

        // Récupération des données du formulaire de connexion
        $email = $this->request->getPost('logemail');
        $password = $this->request->getPost('logpass');

        // Rechercher l'utilisateur dans la base de données
        $user = $model->where('Email', $email)->first();

        if ($user && password_verify($password, $user['Password'])) {
            // Stocker l'utilisateur en session
            session()->set('user', $user);

            // Rediriger vers le dashboard
            return redirect()->to('/dashboard');
        }

        // Retourner à la page de connexion avec un message d'erreur
        return redirect()->back()->with('error', 'Email ou mot de passe incorrect !');
    }

    // Déconnexion
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    // Méthode du tableau de bord
    public function dashboard()
    {
        // Vérifiez si l'utilisateur est connecté
        if (!session()->has('user')) {
            return redirect()->to('/login');
        }

        // Charge la vue du tableau de bord
        return view('dashboard');
    }
}
