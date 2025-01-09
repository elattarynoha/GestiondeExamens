<?php

namespace App\Controller;

class StudentController extends BaseController{

    //Affiche la liste des étudiants pour une filière et un module donnés
    public function afficherEtudiants($filiereID, $moduleID)
    {
        $studentModel = new StudentModel();
        $students = $studentModel->getStudentsByFiliereAndModule($filiereID, $moduleID);

        // Charger la vue avec les données des étudiants
        return view('etudiants/liste', [
            'students' => $students,
            'filiereID' => $filiereID,
            'moduleID' => $moduleID,
        ]);
    }
    public function updateNote()
    {
        $notesModel = new NotesModel();

        $etudiantID = $this->request->getPost('StudentID');
        $moduleID = $this->request->getPost('ModuleID');
        $noteProject = $this->request->getPost('NoteProject');
        $noteCTR = $this->request->getPost('NoteCTR');
        $noteExamFinal = $this->request->getPost('NoteExamFinal');

        // Vérifie si une note existe déjà pour cet étudiant et ce module
        $existingNote = $notesModel->getNotesByStudentAndModule($etudiantID, $moduleID);

        if ($existingNote) {
            // Met à jour les notes
            $notesModel->updateNotes($etudiantID, $moduleID, $noteProject, $noteCTR, $noteExamFinal);
        } else {
            // Insère une nouvelle note
            $notesModel->addNotes($etudiantID, $moduleID, $noteProject, $noteCTR, $noteExamFinal);
        }

        // Redirection avec un message de succès
        return redirect()->back()->with('success', 'Les notes ont été mises à jour avec succès.');
    }
}