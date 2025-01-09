<?php
namespace App\Models;

use CodeIgniter\Model;
class ProfModel extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }

    /**
     * Récupère tous les modules associés à un professeur donné.
     * 
     * @param int $professeurID L'ID du professeur.
     * @return array Liste des modules associés au professeur.
     */
    public function getModulesByProf($professeurID) {
        $this->db->select('modules.ModuleID, modules.NomModule');
        $this->db->from('modules');
        $this->db->join('Professeurs_Modules', 'modules.ModuleID = Professeurs_Modules.ModuleID', 'inner');
        $this->db->where('Professeurs_Modules.ProfesseurID', $professeurID);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    /**
     * Récupère les filières associées à un module spécifique.
     * 
     * @param int $moduleID L'ID du module.
     * @return array Liste des noms des filières associées à ce module.
     */
    public function getFilieresByModule($moduleID) {
        $this->db->select('filieres.NomFiliere');
        $this->db->from('filieres');
        $this->db->join('Filiere_Module', 'filieres.FiliereID = Filiere_Module.FiliereID', 'inner');
        $this->db->where('Filiere_Module.ModuleID', $moduleID);
        $query = $this->db->get();
        return $query->result_array();
    }

}   
