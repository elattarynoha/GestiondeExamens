<?php

namespace App\Controllers;

class StudentDashboard_Controller extends BaseController{
        // Dashboard pour Student
        public function StudentDashboard()
        {
            // Récupérer les informations spécifiques à l'étudiant
            return view('student_dashboard');
        }
}