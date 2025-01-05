<?php 
// AccountModel.php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\UserModel;

class AccountModel extends Model
{
    protected $table = 'accounts'; // Table des comptes
    protected $primaryKey = 'AccountID'; // Clé primaire
    protected $allowedFields = ['UserID', 'RoleID', 'AcademicEmail', 'Password'];
    protected $returnType = 'array';

    protected $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();  // Initialisation du modèle UserModel
    }

    /**
     * Fonction pour créer un compte après vérification des données de l'utilisateur
     */
    public function createAccount(array $data)
    {
        // Vérifier si l'utilisateur existe avec les données fournies
        $userExists = $this->userModel->userExists([
            'CNI' => $data['CNI'],
            'FirstName' => $data['FirstName'],
            'LastName' => $data['LastName'],
            'Birthdate' => $data['Birthdate'],
            'AcademicEmail' => $data['AcademicEmail'],
            'RoleID' => $data['RoleID']
        ]);

        // Si l'utilisateur existe, insérer les données dans la table 'accounts'
        if ($userExists == true) {
            // Hacher le mot de passe avant de l'insérer
            $data['Password'] = password_hash($data['Password'], PASSWORD_BCRYPT);

            // Insérer les données dans la table 'accounts'
            $insertID = $this->insert([
                'UserID' => $data['UserID'],       // L'ID de l'utilisateur
                'RoleID' => $data['RoleID'],       // Le rôle de l'utilisateur
                'AcademicEmail' => $data['AcademicEmail'],  // Email académique
                'Password' => $data['Password']    // Mot de passe haché
            ]);

            if ($insertID) {
                return [
                    'status' => true,
                    'message' => 'Compte créé avec succès.',
                    'AccountID' => $insertID
                ];
            }

            return [
                'status' => false,
                'message' => 'Échec de la création du compte.'
            ];
        }

        // Si l'utilisateur n'existe pas, renvoyer un message d'erreur
        return [
            'status' => false,
            'message' => 'Les données de l\'utilisateur ne correspondent pas à un enregistrement existant.'
        ];
    }
}

?>