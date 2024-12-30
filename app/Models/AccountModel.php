<?php 
namespace App\Models;
use CodeIgniter\Model;

class AccountModel extends Model {

    protected $table = 'Account'; // Table des comptes
    protected $primaryKey = 'AccountID';
    
    // Vérifier si l'utilisateur possède déjà un compte
    public function userHasAccount(int $userID): bool {
        // Cherche si un compte existe pour cet UserID
        $account = $this->where('UserID', $userID)->first();
        return !empty($account); // Retourne true si un compte existe, sinon false
    }
}
?>