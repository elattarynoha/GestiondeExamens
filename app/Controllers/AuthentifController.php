<?php
namespace App\Controllers;

use App\Models\UserModel;
use App\Models\AccountModel;

class AuthentifController extends BaseController{

    public function register(){
        //Affichage de la page : REGISTER
        return view('register');
    }
    public function login(){
        //Affichage de la page : LOGIN
        return view('login');
    }
    // Processus d'inscription
    public function SignUp_Process(){
        $accountmodel = new AccountModel();
        $Usermodel = new UserModel();
         
        //Récupérer les données de formulaire
        $data_register = [
            'FirstName' => $this->request->getPost('UserName'),
            'LastName' => $this->request->getPost('UserFname'),
            'AcademicEmail' => $this->request->getPost('UserEmail'),
        ];

        //Empêcher la création d’un compte si un compte existe déjà pour le mème User
        $existingAccount = $accountmodel->where('AcademicEmail', $data_register['AcademicEmail'])->first();
        if ($existingAccount) {
            return redirect()->back()->with('error', 'An account already exists for this user.');   
        }else{
        // Tester si l'user est inscrit dans notre système (Table Users) pour lui créer un compte
        $UserExisting= $Usermodel->where('AcademicEmail',$data_register['AcademicEmail'])->first();
        if($UserExisting){
            $data_account = [
                'UserID' => $UserExisting['UserID'],
                'RoleID' => $UserExisting['RoleID'],
                'AcademicEmail' => $data_register['AcademicEmail'],
                'Password' => password_hash($this->request->getPost('UserPass'), PASSWORD_DEFAULT),
            ];

        // Insérer l'user dans la table accounts
        if ($accountmodel->insert($data_account)) {
            // Rediriger vers la page de connexion avec un message de succès
            return redirect()->to('/login')->with('success', 'Account created successfully!');
        }else {
            // Si l'insertion échoue, Rediriger avec un message d'erreur
            return redirect()->back()->with('error', 'ERROR : Ops! Try again');
        }
        }else{
             // L'utilisateur n'existe pas dans la table 'users'
        return redirect()->back()->with('error', 'User not found !');
        } 

            }
    }

    //Processus de Login
    public function SignIn_Process(){
        $accountmodel = new AccountModel();
    
        // Récupérer data depuis le formulaire de connexion
        $email = $this->request->getPost('logemail');
        $password = $this->request->getPost('logpass');
    
        // Chercher l'User dans la table accounts
        $User = $accountmodel->where('AcademicEmail', $email)->first(); 
        
        // Tester les données entrées
        if ($User && password_verify($password, $User['Password'])) {
            // Créer une session pour l'utilisateur
            session()->set('user', [
                'UserID' => $User['UserID'],
                'UserName' => $User['LastName'],
                'UserFname' => $User['FirstName'],
                'AcademicEmail' => $User['AcademicEmail'],
                'AccountID' => $User['AccountID'],
                'RoleID' => $User['RoleID']
            ]);
    
            // Rediriger l'utilisateur vers son dashboard
            if ($User['RoleID'] == 1) {
                return redirect()->to('/StudentDashboard');
            } elseif ($User['RoleID'] == 2) {
                return redirect()->to('/ProfDashboard');
            } else {
                return redirect()->to('/login')->with('error', "ERROR : Ops! Try again");
            }
        }
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