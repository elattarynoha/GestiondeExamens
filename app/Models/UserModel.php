<?php
// UserModel.php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users'; // Table des utilisateurs
    protected $primaryKey = 'UserID'; // Clé primaire
    protected $allowedFields = ['CNI', 'FirstName', 'LastName', 'Birthdate', 'AcademicEmail', 'RoleID'];
    protected $returnType = 'array';

    /**
     * Vérifier si un utilisateur existe avec les données fournies
     */
    public function userExists(array $userData)
    {
        // On cherche un utilisateur dont les champs correspondent à ceux fournis
        $user = $this->where([
            'CNI' => $userData['CNI'],
            'FirstName' => $userData['FirstName'],
            'LastName' => $userData['LastName'],
            'Birthdate' => $userData['Birthdate'],
            'AcademicEmail' => $userData['AcademicEmail'],
            'RoleID' => $userData['RoleID']
        ])->first();

        // Si un utilisateur est trouvé, on retourne true
        if ($user) {
            return true;
        }

        // Si aucun utilisateur n'est trouvé, on retourne false
        return false;
    }
}
?>