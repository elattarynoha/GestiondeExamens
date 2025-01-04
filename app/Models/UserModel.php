<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users'; // Nom de la table
    protected $primaryKey = 'UserID'; // Nom de la clé primaire
    protected $allowedFields = ['CNI', 'FirstName', 'LastName', 'Birthdate', 'AcademicEmail', 'RoleID']; // Champs autorisés pour insert et update
    protected $returnType = 'array';

    /**
     * Fonction de connexion d'utilisateur
     */
    public function login(string $email, string $password)
    {
        // Rechercher l'utilisateur par email dans la table accounts
        $builder = $this->db->table('accounts');
        $builder->select('accounts.*, roles.RoleName');
        $builder->join('roles', 'accounts.RoleID = roles.RoleID');
        $builder->where('accounts.AcademicEmail', $email);
        $user = $builder->get()->getRowArray();

        // Vérifier si l'utilisateur existe et si le mot de passe correspond
        if ($user && password_verify($password, $user['Password'])) {
            return [
                'AccountID' => $user['AccountID'],
                'UserID'    => $user['UserID'],
                'RoleID'    => $user['RoleID'],
                'RoleName'  => $user['RoleName'],
            ];
        }

        return null; 
    // Retourner null si l'authentification échoue
    }

    /**
     * Fonction d'inscription d'utilisateur
     */
//     public function register(array $data)
//     {
//         // Vérifier si l'email académique est déjà utilisé
//         $existingUser = $this->db->table('accounts')->where('AcademicEmail', $data['AcademicEmail'])->get()->getRowArray();
//         if ($existingUser) {
//             return [
//                 'status' => false,
//                 'message' => 'Cet email est déjà enregistré.'
//             ];
//         }

//         // Insérer les données utilisateur dans la table users
//         $userData = [
//             'CNI'           => $data['CNI'],
//             'FirstName'     => $data['FirstName'],
//             'LastName'      => $data['LastName'],
//             'Birthdate'     => $data['Birthdate'],
//             'AcademicEmail' => $data['AcademicEmail'],
//             'RoleID'        => $data['RoleID'], // ID du rôle (1 = admin, 2 = professeur, 3 = étudiant, etc.)
//         ];
//         $this->db->table('users')->insert($userData);
//         $userID = $this->db->insertID();

//         // Hacher le mot de passe avant de l'insérer dans la table accounts
//         $accountData = [
//             'UserID'        => $userID,
//             'RoleID'        => $data['RoleID'],
//             'AcademicEmail' => $data['AcademicEmail'],
//             'Password'      => password_hash($data['Password'], PASSWORD_BCRYPT),
//         ];

//         $this->db->table('accounts')->insert($accountData);

//         if ($userID) {
//             return [
//                 'status' => true,
//                 'message' => 'Utilisateur enregistré avec succès.',
//                 'UserID' => $userID
//             ];
//         }

//         return [
//             'status' => false,
//             'message' => 'Échec de l\'enregistrement. Veuillez réessayer.'
//         ];
//     }
 }