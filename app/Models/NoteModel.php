<?php
namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Notes;      // Entité Notes
use App\Models\StudentModel; // Modèle pour gérer les étudiants

class NoteModel extends Model
{
    protected $table = 'notes';                 // Table des notes
    protected $primaryKey = 'NoteID';           // Clé primaire
    protected $returnType = Notes::class;       // Retourne une entité Notes
    protected $allowedFields = ['EtudiantID', 'ModuleID', 'Note']; // Champs modifiables

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Ajoute une nouvelle note pour un étudiant en utilisant son nom et prénom.
     * 
     * @param string $firstName Prénom de l'étudiant.
     * @param string $lastName Nom de l'étudiant.
     * @param int $moduleID L'ID du module.
     * @param float $note La note à attribuer.
     * @return bool|int Retourne l'ID de la nouvelle note ou false en cas d'échec.
     */
    public function addNoteByStudentName(string $firstName, string $lastName, int $moduleID, float $note)
    {
        // Validation de la note (0 <= note <= 20)
        if ($note < 0 || $note > 20) {
            throw new \InvalidArgumentException('La note doit être comprise entre 0 et 20.');
        }

        // Récupérer l'ID de l'étudiant
        $studentModel = new StudentModel();
        $studentID = $studentModel->getStudentIDByName($firstName, $lastName);

        if (!$studentID) {
            throw new \RuntimeException('This Student doesn"t exist.');
        }

        // Crée une nouvelle instance de l'entité Notes
        $noteEntity = new Notes();
        $noteEntity->StudentID = $studentID;
        $noteEntity->ModuleID = $moduleID;
        $noteEntity->Note = $note;

        // Insère la note dans la base de données
        return $this->insert($noteEntity);
    }

    /**
     * Récupère les notes des étudiants avec leur nom, prénom et la note.
     * 
     * @param int $moduleID L'ID du module pour lequel les notes doivent être récupérées.
     * @return array Liste des notes avec les informations des étudiants (nom, prénom, note).
     */
    public function getNotesWithStudentInfo(int $moduleID): array
    {
        // Charger le modèle StudentModel
        $studentModel = new StudentModel();

        // Récupérer les notes pour un module donné
        $builder = $this->db->table('notes');
        $builder->select('notes.Note, users.FirstName, users.LastName');
        $builder->join('users', 'users.UserID = notes.EtudiantID');
        $builder->where('notes.ModuleID', $moduleID);
        $query = $builder->get();

        // Récupérer les résultats
        $results = $query->getResultArray();

        // Formatage des résultats pour afficher nom, prénom et note
        $notesWithStudentInfo = [];

        foreach ($results as $row) {
            $notesWithStudentInfo[] = [
                'FirstName' => $row['FirstName'],
                'LastName'  => $row['LastName'],
                'Note'      => $row['Note']
            ];
        }

        return $notesWithStudentInfo;
    }
  

        /**
         * Met à jour la note d'un étudiant en utilisant son nom, prénom et la nouvelle note.
         * 
         * @param string $firstName Le prénom de l'étudiant.
         * @param string $lastName Le nom de l'étudiant.
         * @param int $moduleID L'ID du module.
         * @param float $newNote La nouvelle note à attribuer.
         * @return bool Retourne vrai si la mise à jour est réussie, sinon faux.
         */
    public function updateNoteByName(string $firstName, string $lastName, int $moduleID, float $newNote): bool
        {
            // Validation de la note (0 <= note <= 20)
            if ($newNote < 0 || $newNote > 20) {
                throw new \InvalidArgumentException('La note doit être comprise entre 0 et 20.');
            }
    
            // Instancier le modèle StudentModel pour récupérer l'ID
            $studentModel = new StudentModel();
            $etudiantID = $studentModel->getStudentIDByName($firstName, $lastName);
    
            // Si l'étudiant est trouvé, on met à jour la note
            if ($etudiantID !== null) {
                // Vérifier si la note existe déjà pour cet étudiant et module
                $builder = $this->db->table('notes');
                $builder->where('EtudiantID', $etudiantID);
                $builder->where('ModuleID', $moduleID);
                $query = $builder->get();
    
                // Si la note existe, on la met à jour
                if ($query->getNumRows() > 0) {
                    return $this->update(
                        ['EtudiantID' => $etudiantID, 'ModuleID' => $moduleID],  // Clé primaire
                        ['Note' => $newNote]   // Valeur à mettre à jour
                    );
                }
            }
    
            return false; // Si l'étudiant n'existe pas, retour faux
        }   
    
}