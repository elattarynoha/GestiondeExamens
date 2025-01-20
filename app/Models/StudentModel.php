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
        $builder->where('RoleID', 1); 

        $query = $builder->get();
        $result = $query->getRow();

        return $result ? $result->UserID : null;
    }
    // Dans le modèle NoteModel ou StudentModel
    public function getStudentsWithNotes(int $moduleID)
    {
        $builder = $this->db->table('notes');
        $builder->select('notes.Note, users.FirstName, users.LastName, modules.NomModule');
        $builder->join('users', 'users.UserID = notes.StudentID');
        $builder->join('modules', 'modules.ModuleID = notes.ModuleID');
        $builder->where('notes.ModuleID', $moduleID);
        $query = $builder->get();

        return $query->getResultArray(); // Retourne les résultats
    }

}
