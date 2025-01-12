<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\Entities\Users; // Import correct de l'entité

class UserModel extends Model
{
    protected $table = 'users'; // Table des utilisateurs
    protected $primaryKey = 'UserID'; // Clé primaire
    protected $allowedFields = ['FirstName', 'LastName', 'AcademicEmail', 'RoleID'];
    protected $returnType = Users::class; // Retourne une instance de l'entité Users

    /**
     * Vérifier si un utilisateur existe avec les données fournies
     *
     * @param array $userData
     * @return bool
     */
    public function userExists(array $userData): bool
    {
        $user = $this->where([
            'FirstName' => $userData['FirstName'],
            'LastName' => $userData['LastName'],
            'AcademicEmail' => $userData['AcademicEmail'],
            'RoleID' => $userData['RoleID']
        ])->first();

        return $user !== null;
    }
}
?>