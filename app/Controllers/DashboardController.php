<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    // Dashboard pour Student
    public function StudentDashboard()
    {
        // Récupérer les informations spécifiques à l'étudiant
        return view('student_dashboard');
    }

    // Dashboard pour professeur
    public function ProfDashboard()
    {
        return view('prof_dashboard');
    }
}

/*

-----------------------------
CREATE TABLE module_notes (
    NoteID INT AUTO_INCREMENT PRIMARY KEY,
    StudentID INT,  -- Référence à l'étudiant
    ModuleID INT,   -- Référence au module
    NoteProject DECIMAL(5, 2),
    NoteCTR DECIMAL(5, 2),
    NoteExamFinal DECIMAL(5, 2),
    FOREIGN KEY (StudentID) REFERENCES students(StudentID) ON DELETE CASCADE,
    FOREIGN KEY (ModuleID) REFERENCES modules(ModuleID) ON DELETE CASCADE
);
---------------------------
CREATE TABLE modules (
    ModuleID INT AUTO_INCREMENT PRIMARY KEY, 
    ModuleName VARCHAR(100) NOT NULL,  -- Nom du module
    ProfessorID INT,  -- Référence au professeur
    FOREIGN KEY (ProfessorID) REFERENCES users(UserID) ON DELETE CASCADE
);
----------------------------
CREATE TABLE students (
    StudentID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT,                              -- Référence à l'utilisateur
    Filiere ENUM('IL', 'IISE', 'ADIA') NOT NULL,  -- Filtrée avec les 3 filières
    FOREIGN KEY (UserID) REFERENCES users(UserID) ON DELETE CASCADE
);
*/