<?php
namespace App\Controllers;

use App\Models\ProfModel;

class ModuleController extends BaseController
{

    public function showModules()
    {
        // ID du professeur connecté
        $prof_ID = session()->get('user')['UserID'];

        // Charger le modèle
        $profModel = new ProfModel();

        // Récupérer les modules associés
        $LesModules = $profModel->getModulesByProf($prof_ID);

        // Passer les modules à la vue TableModule
        return view('TableModule', ['modules' => $LesModules]);
    }


  

}
