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
        // Récupérer les informations spécifiques au professeur
        return view('prof_dashboard');
    }
}
