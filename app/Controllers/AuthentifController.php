<?php
namespace App\Controllers;

use App\Models\UserModel;
use App\Models\AccountModel;

class AuthentifController extends BaseController{

    public function login(){
        //Affichage de la page : LOGIN
        return view('login');
    }

    public function register(){
        //Affichage de la page : REGISTER
        return view('register');
    }

    // Processus d'inscription
    public function SignUp_Process()
    {
        $accountmodel = new AccountModel();
        $Usermodel = new UserModel();
    
        $data_register = [
            'FirstName' => $this->request->getPost('UserName'),
            'LastName' => $this->request->getPost('UserFname'),
            'AcademicEmail' => $this->request->getPost('UserEmail'),
        ];
    
        // Vérifier si un compte existe déjà
        $existingAccount = $accountmodel->where('AcademicEmail', $data_register['AcademicEmail'])->first();
        if ($existingAccount) {
            return redirect()->back()->withInput()->with('general_error', 'An account already exists for this user.');
        }
    
        // Vérifier si l'utilisateur existe dans la table Users
        $UserExisting = $Usermodel->where('AcademicEmail', $data_register['AcademicEmail'])->first();
        if (!$UserExisting) {
            return redirect()->back()->withInput()->with('general_error', 'User not found in the system.');
        }
    
        // Créer un nouveau compte
        $data_account = [
            'UserID' => $UserExisting['UserID'],
            'RoleID' => $UserExisting['RoleID'],
            'AcademicEmail' => $data_register['AcademicEmail'],
            'Password' => password_hash($this->request->getPost('UserPass'), PASSWORD_DEFAULT),
        ];
    
        if ($accountmodel->insert($data_account)) {
            return redirect()->to('/login')->with('success', 'Account created successfully!');
        } else {
            return redirect()->back()->withInput()->with('general_error', 'ERROR: Failed to create account. Try again.');
        }
    }

    // Processus de Login
    public function SignIn_Process()
{
    $accountmodel = new AccountModel();

    // Récupérer les données du formulaire
    $email = $this->request->getPost('logemail');
    $password = $this->request->getPost('logpass');

    // Chercher l'utilisateur dans la table accounts
    $User = $accountmodel->where('AcademicEmail', $email)->first();

    // Vérifier si l'utilisateur existe
    if (!$User) {
        return redirect()->back()->withInput()->with('general_error', 'Email not found. Please check your email.');
    }

    // Vérifier si le mot de passe est correct
    if (password_verify($password, $User->Password)) {
        // Authentification réussie
        session()->set('user', $User->toArray());

        // Rediriger vers le tableau de bord approprié
        switch ($User->RoleID) {
            case 1:
                return redirect()->to('/StudentDashboard');
            case 2:
                return redirect()->to('/ProfDashboard');
            default:
                return redirect()->to('/login')->with('error', 'Role not recognized. Try again.');
        }
    }

    // Mot de passe incorrect
    return redirect()->back()->withInput()->with('general_error', 'Password incorrect! Please try again.');
}
    
    
    //Processus de Logout
    public function logout(){
        session()->destroy();
        return redirect()->to('/login');
    }
        /*
    // Méthode privée pour valider l'email
     private function isValidUizEmail($email)
     {
         return preg_match('/^[a-zA-Z]+\.[a-zA-Z]+@uiz\.ac\.ma$/', $email);
     }
         */
}