<?php
namespace App\Models;

use CodeIgniter\Model;
use App\Models\Entities\Modules;  // Entité Modules
use App\Models\Entities\Filieres; // Entité Filieres

class ProfModel extends Model
{
    protected $table = 'Prof_Module'; // Table pivot entre professeurs et modules
    protected $primaryKey = null;            // Pas de clé primaire
    protected $returnType = 'array';         // Peut être modifié si nécessaire
    protected $allowedFields = ['ProfesseurID', 'ModuleID'];

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Récupère tous les modules associés à un professeur donné.
     * 
     * @param int $professeurID L'ID du professeur.
     * @return array Liste des modules associés au professeur.
     */
    public function getModulesByProf(int $professeurID): array
    {
        $builder = $this->db->table('modules');
        $builder->select('modules.ModuleID, modules.NomModule'); // Sélectionner ID et Nom
        $builder->join('Prof_Module', 'modules.ModuleID = Prof_Module.ModuleID', 'inner');
        $builder->where('Prof_Module.ProfesseurID', $professeurID);
        $query = $builder->get();

        // Retourner un tableau contenant les noms des modules
        return array_column($query->getResultArray(), 'NomModule');
    }

    /**
     * Récupère les filières associées à un module spécifique.
     * 
     * @param int $moduleID L'ID du module.
     * @return array Liste des noms des filières associées à ce module.
     */
    public function getFilieresByModule(int $moduleID): array
    {
        $builder = $this->db->table('filieres');
        $builder->select('filieres.FiliereID, filieres.NomFiliere'); // Sélectionner ID et Nom
        $builder->join('Filiere_Module', 'filieres.FiliereID = Filiere_Module.FiliereID', 'inner');
        $builder->where('Filiere_Module.ModuleID', $moduleID);
        $query = $builder->get();

        // Retourner les résultats en tableau associatif
        return $query->getResultArray();
    }
}