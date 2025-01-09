<?php
// AccountModel.php

namespace App\Models;

use CodeIgniter\Model;

class AccountModel extends Model
{
    protected $table = 'accounts'; // Table des comptes
    protected $primaryKey = 'AccountID'; // Clé primaire
    protected $allowedFields = ['UserID', 'RoleID', 'AcademicEmail', 'Password'];
    protected $returnType = 'array';

    /**
     * Vérifier si un compte existe avec les données fournies.
     */
    public function accountExists(array $accountData)
    {
        // Rechercher un compte dont les champs correspondent à ceux fournis
        $account = $this->where([
            'UserID' => $accountData['UserID'],
            'AcademicEmail' => $accountData['AcademicEmail'],
            'RoleID' => $accountData['RoleID']
        ])->first();

        // Si un compte est trouvé, retourner true
        if ($account) {
            return true;
        }

        // Si aucun compte n'est trouvé, retourner false
        return false;
    }
}
?>
