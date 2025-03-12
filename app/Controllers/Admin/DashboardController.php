<?php

namespace App\Controllers\Admin;

use App\Models\Student;
use App\Controllers\Controller;
use App\Exceptions\NotFoundException;

class DashboardController extends Controller{
    
    public function index(){
        $student = new Student($this->getDB());

        // Ajout des comptages
        $totalCount = $student->countByGender();
        $maleCount = $student->countByGender('M');
        $femaleCount = $student->countByGender('F');

        return $this->viewAdmin('admin.dashboard.index',compact('maleCount', 'femaleCount', 'totalCount'));
    }

}