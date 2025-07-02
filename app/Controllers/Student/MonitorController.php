<?php

namespace App\Controllers\Student;

use App\Models\Post;
use App\Controllers\Controller;
use App\Exceptions\NotFoundException;

class MonitorController extends Controller{

    public function index(){
        $this->isStudent();

        if (!is_numeric($_SESSION['idStaUser']) || floor($_SESSION['idStaUser']) != $_SESSION['idStaUser']) {
            throw new NotFoundException("L'identifiant du post doit être un entier.");
        }

        $_SESSION['idStaUser'] = (int)$_SESSION['idStaUser']; // Conversion explicite en entier
        $post = new Post($this->getDB());
        $post = $post->findByIdStagiaire($_SESSION['idStaUser']);

        if (!$post) {
            throw new NotFoundException("Aucun post trouvé avec l'identifiant : $_SESSION[idStaUser]");
        }

        return $this->viewStudent('student.monitor.index',compact('post'));
    }
}