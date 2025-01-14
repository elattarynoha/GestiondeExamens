<?php
namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Users; // Utilisez l'entité Users ici

class StudentModel extends Model
{
    protected $table = 'users';            // Table des utilisateurs (étudiants)
    protected $primaryKey = 'UserID';      // Clé primaire
    protected $returnType = Users::class;  // Retourne une entité Users
    protected $allowedFields = ['FirstName', 'LastName', 'AcademicEmail', 'RoleID']; // Champs modifiables

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Récupère l'ID d'un étudiant à partir de son nom et prénom.
     * 
     * @param string $firstName Prénom de l'étudiant.
     * @param string $lastName Nom de l'étudiant.
     * @return int|null Retourne l'ID de l'étudiant ou null si introuvable.
     */
    public function getStudentIDByName(string $firstName, string $lastName): ?int
    {
        $builder = $this->db->table($this->table);
        $builder->select('UserID');
        $builder->where('FirstName', $firstName);
        $builder->where('LastName', $lastName);
        $builder->where('RoleID', 3); // Supposons que 3 correspond au rôle "étudiant"

        $query = $builder->get();
        $result = $query->getRow();

        return $result ? $result->UserID : null;
    }
}
