<?php

namespace App\Controllers;

class ProfDashboard_Controller extends BaseController{
        // Dashboard pour professeur
        public function ProfDashboard()
        {
            return view('prof_dashboard');
        }
}