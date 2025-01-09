<?php

namespace App\Controllers;

class ProfController extends BaseController{
    
    // Récupérer les modules associés au prof:
    public function getModulesProf(){
    // Session du professeur connecté:
    $prof_ID= session()->get('user')['UserID'];
    $profModel = new ProfModel();
    $LesModules = $profModel->getModules($prof_ID);
    // Passer les modules en view:
    return view('prof_dashboard',['modules' => $LesModules]);
    }


}