<?php
namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Accounts; // Importation de l'entité Accounts
use App\Models\UserModel;

class AccountModel extends Model
{
    protected $table = 'accounts'; // Table des comptes
    protected $primaryKey = 'AccountID'; // Clé primaire
    protected $allowedFields = ['UserID', 'RoleID', 'AcademicEmail', 'Password'];
    protected $returnType = Accounts::class; // Retourne une instance de l'entité Accounts

    protected $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();  // Initialisation du modèle UserModel
    }

    /**
     * Fonction pour authentifier un utilisateur et retourner un objet Accounts.
     *
     * @param string $email
     * @param string $password
     * @return Accounts|null
     */
    public function login(string $email, string $password)
    {
        // Rechercher l'utilisateur par email dans la table accounts
        $builder = $this->db->table('accounts');
        $builder->select('accounts.*, roles.RoleName');
        $builder->join('roles', 'accounts.RoleID = roles.RoleID');
        $builder->where('accounts.AcademicEmail', $email);
        $user = $builder->get()->getRow(); // Utilisation de getRow pour un objet

        // Vérifier si l'utilisateur existe et si le mot de passe correspond
        if ($user && password_verify($password, $user->Password)) {
            $accountEntity = new Accounts((array) $user); // Convertir en instance de Accounts
            return $accountEntity;
        }

        return null; // Retourner null si l'authentification échoue
    }

    /**
     * Enregistrer un nouvel utilisateur après vérification.
     *
     * @param array $data
     * @return array
     */
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
        if ($userExists) {
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
            'message' => 'User data does not match an existing record. (This error comes from AccountModel).'
        ];
    }
}
