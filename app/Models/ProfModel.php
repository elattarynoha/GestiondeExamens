<?php
namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Modules;  // Entité Modules
use App\Entities\Filieres; // Entité Filieres

class ProfModel extends Model
{
    protected $table = 'Prof_Module';
    protected $primaryKey = null;          
    protected $returnType = 'array';       
    protected $allowedFields = ['ProfesseurID', 'ModuleID'];

    public function __construct()
    {
        parent::__construct();
    }

    public function getModulesByProf(int $professeurID): array
    {
        $builder = $this->db->table('modules');
        $builder->select('modules.ModuleID, modules.NomModule'); // Sélectionner ID et Nom
        $builder->join('Prof_Module', 'modules.ModuleID = Prof_Module.ModuleID', 'inner');
        $builder->where('Prof_Module.ProfesseurID', $professeurID);
        $query = $builder->get();

        // Retourner un tableau contenant les noms des modules
        return $query->getResultArray();
    }
       // Fonction pour récupérer un module par son nom
       public function getModuleByName(string $moduleName)
       {
           $builder = $this->db->table('modules'); 
           $builder->select('ModuleID');
           $builder->where('NomModule', $moduleName); 
           $query = $builder->get();
           $row = $query->getRowArray();
           return $row ? $row['ModuleID'] : null;
       }

            public function getModuleNameById($moduleID)
        {
            $builder = $this->db->table('modules');
            $builder->select('NomModule');
            $builder->where('ModuleID', $moduleID);
            $query = $builder->get();
            $result = $query->getRowArray();
            return $result ? $result['NomModule'] : null;
        }
        // Fonction pour recupérer le nom du module pour la table des étudiants
    public function getModulesByProfForNotes(int $professeurID): ?string
    {
        $builder = $this->db->table('modules');
        $builder->select('modules.NomModule'); // Sélectionner ID et Nom
        $builder->join('Prof_Module', 'modules.ModuleID = Prof_Module.ModuleID', 'inner');
        $builder->where('Prof_Module.ProfesseurID', $professeurID);
        $query = $builder->get();

          // Récupérer la première ligne
        $result = $query->getRow();

        return $result ? $result->NomModule : null;
    }
}