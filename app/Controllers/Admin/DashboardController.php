<?php

namespace App\Controllers\Admin;

use App\Models\Post;
use App\Models\Student;
use App\Controllers\Controller;
use App\Exceptions\NotFoundException;

class DashboardController extends Controller{
    
    public function index(){
        $this->isAdmin();

        if (!is_numeric($_SESSION['user']) || floor($_SESSION['user']) != $_SESSION['user']) {
            throw new NotFoundException("L'identifiant du post doit être un entier.");
        }

        $_SESSION['user'] = (int)$_SESSION['user']; // Conversion explicite en entier
        $post = new Post($this->getDB());
        $post = $post->findProfil($_SESSION['user']);

        if (!$post) {
            throw new NotFoundException("Aucun post trouvé avec l'identifiant : $_SESSION[user]");
        }
        
        // $student = new Student($this->getDB());

        // // Ajout des comptages
        // $totalCount = $student->countByGender();
        // $maleCount = $student->countByGender('M');
        // $femaleCount = $student->countByGender('F');

        return $this->viewAdmin('admin.dashboard.index',compact('post'));
    }

}