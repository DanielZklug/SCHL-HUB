<?php

namespace App\Controllers\Admin;

use App\Models\Post;
use App\Models\Student;
use App\Controllers\Controller;
use App\Exceptions\NotFoundException;

class DashboardController extends Controller{
    
    public function index(){
        $this->isAdmin();

        if (!is_numeric($_SESSION['idEncUser']) || floor($_SESSION['idEncUser']) != $_SESSION['idEncUser']) {
            throw new NotFoundException("L'identifiant du post doit être un entier.");
        }

        $_SESSION['idEncUser'] = (int)$_SESSION['idEncUser']; // Conversion explicite en entier
        $post = new Post($this->getDB());
        $post = $post->findProfil($_SESSION['idEncUser']);

        if (!$post) {
            throw new NotFoundException("Aucun post trouvé avec l'identifiant : $_SESSION[idEncUser]");
        }

        // Appelle la méthode pour récupérer les statistiques
        $statistics = (new Post($this->getDB()))->getEncadrantStatistics($_SESSION['idEncUser']);
        
        // $student = new Student($this->getDB());

        // // Ajout des comptages
        // $totalCount = $student->countByGender();
        // $maleCount = $student->countByGender('M');
        // $femaleCount = $student->countByGender('F');

        return $this->viewAdmin('admin.dashboard.index',compact('post','statistics'));
    }

}