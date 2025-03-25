<?php

namespace App\Controllers\Student;

use App\Models\Post;
use App\Models\Student;
use App\Controllers\Controller;
use App\Exceptions\NotFoundException;

class DashboardController extends Controller{
    
    public function index(){

        if (!is_numeric($_SESSION['idStaUser']) || floor($_SESSION['idStaUser']) != $_SESSION['idStaUser']) {
            throw new NotFoundException("L'identifiant du post doit être un entier.");
        }

        $_SESSION['idStaUser'] = (int)$_SESSION['idStaUser']; // Conversion explicite en entier
        $post = new Student($this->getDB());
        $post = $post->findByIdStagiaire($_SESSION['idStaUser']);

        if (!$post) {
            throw new NotFoundException("Aucun post trouvé avec l'identifiant : $_SESSION[idStaUser]");
        }
        
        // $student = new Student($this->getDB());

        // // Ajout des comptages
        // $totalCount = $student->countByGender();
        // $maleCount = $student->countByGender('M');
        // $femaleCount = $student->countByGender('F');

        return $this->viewStudent('student.dashboard.index',compact('post'));
    }

}