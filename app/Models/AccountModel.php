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
            'FirstName' => $data['FirstName'],
            'LastName' => $data['LastName'],
            'AcademicEmail' => $data['AcademicEmail'],
            'RoleID' => $data['RoleID']
        ]);

        // Si l'utilisateur existe, insérer les données dans la table 'accounts'
        if ($userExists == true) {

            // Hacher le mot de passe avant de l'insérer
            $data['Password'] = password_hash($data['Password'], PASSWORD_DEFAULT);

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
                    'message' => 'Account successfully created.',
                    'AccountID' => $insertID
                ];
            }

            return [
                'status' => false,
                'message' => 'Account creation failed.'
            ];
        }

        // Si l'utilisateur n'existe pas, renvoyer un message d'erreur
        return [
            'status' => false,
            'message' => 'User data does not match an existing record. (This error comes from AccountModel)'
        ];
    }
}

?>