<?php 
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

    /*
     * Fonction pour créer un compte après vérification des données de l'utilisateur
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

        return null; // Retourner null si l'authentification échoue
    }


    public function register(array $data)
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
                'AcademicEmail' => $data['AcademicEmail'],  // Email académique de l'utilisateur
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
            'message' => 'Les données de l\'utilisateur ne correspondent pas à un enregistrement existant.(cet erreur vienne de AccountModel)'
        ];
    }
}

?>