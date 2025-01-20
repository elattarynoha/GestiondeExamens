<?php

namespace App\Controllers;

use App\Models\NoteModel;
use App\Models\StudentModel;
use App\Models\ProfModel;

    
    class StudentController extends BaseController {
        public function load_table_etu()
        {
           $profID = session()->get('user')['UserID'];

            $profModel = new ProfModel();
            $noteModel = new NoteModel();
            $students = $noteModel->getAllNotesWithStudentInfo(); 
            $moduleName = $profModel->getModulesByProfForNotes($profID);

            return view('TableEtu', ['students' => $students, 'moduleName' => $moduleName]);
        }
        
        public function addNote() {
            // Récupérer les données du formulaire
            $firstName = $this->request->getPost('student-firstname');
            $lastName = $this->request->getPost('student-name');
            $moduleName = $this->request->getPost('module-name');
            $note = (float)$this->request->getPost('final-grade');

            $moduleModel = new ProfModel();
            $moduleID = $moduleModel->getModuleByName($moduleName); 
    
            if (!$moduleID) {
                // Si le module n'existe pas, afficher un message d'erreur
                return redirect()->back()->with('error', 'Le module n\'existe pas.');
            }
            // Ajouter la note via le modèle NoteModel
            $noteModel = new NoteModel();
            $noteModel->addNoteByStudentName($firstName, $lastName, $moduleID, $note);
            return redirect()->to('/load_table_etudiant');
        }
        
        public function updateNote()
{
    // Récupérer les données du formulaire
    $firstName = $this->request->getPost('student-firstname');
    $lastName = $this->request->getPost('student-name');
    $moduleName = $this->request->getPost('module-name');
    $newNote = (float)$this->request->getPost('final-grade');

    // Instancier le modèle ProfModel pour récupérer l'ID du module
    $moduleModel = new ProfModel();
    $moduleID = $moduleModel->getModuleByName($moduleName); 

    if (!$moduleID) {
        // Si le module n'existe pas, afficher un message d'erreur
        return redirect()->back()->with('error', 'Le module n\'existe pas.');
    }

    // Instancier le modèle NoteModel pour mettre à jour la note
    $noteModel = new NoteModel();
    try {
        // Appeler la méthode pour mettre à jour la note
        $updated = $noteModel->updateNoteByName($firstName, $lastName, $moduleID, $newNote);
        
        if ($updated) {
            return redirect()->to('/load_table_etudiant')->with('success', 'Note mise à jour avec succès.');
        } else {
            return redirect()->back()->with('error', 'La mise à jour a échoué.');
        }
    } catch (\InvalidArgumentException $e) {
        return redirect()->back()->with('error', $e->getMessage());
    }
}

    
    }
    
