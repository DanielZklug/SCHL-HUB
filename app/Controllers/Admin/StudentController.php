<?php

namespace App\Controllers\Admin;

use App\Models\Post;
use App\Models\Student;
use App\Controllers\Controller;
use App\Exceptions\NotFoundException;

class StudentController extends Controller{
    
    public function index(){
        $this->isAdmin();

        if (!is_numeric($_SESSION['idEncUser']) || floor($_SESSION['idEncUser']) != $_SESSION['idEncUser']) {
            throw new NotFoundException("L'identifiant du post doit être un entier.");
        }

        $_SESSION['idEncUser'] = (int)$_SESSION['idEncUser']; // Conversion explicite en entier
        $post = new Post($this->getDB());
        $post = $post->findProfil($_SESSION['idEncUser']);

        if (!$post) {
            throw new NotFoundException("Aucun post trouvé avec l'identifiant : {$_SESSION['idEncUser']}");
        }

        return $this->viewAdmin('admin.student.index', compact('post'));
    }


    public function show($id) {
        $this->isAdmin();
    
        if (!is_numeric($id) || floor($id) != $id) {
            throw new NotFoundException("L'identifiant du post doit être un entier.");
        }

        $id = (int)$id; // Conversion explicite en entier
        $post = new Student($this->getDB());
        $posts = $post->findByIdStagiaire($id);

        if (!$post) {
            throw new NotFoundException("Aucun post trouvé avec l'identifiant : $id");
        }

        $_SESSION['idEncUser'] = (int)$_SESSION['idEncUser']; // Conversion explicite en entier
        $post = new Post($this->getDB());
        $post = $post->findProfil($_SESSION['idEncUser']);


        return $this->viewAdmin('admin.student.show', compact('posts','post'));
    }

    public function delete(int $id){
        $this->isAdmin();

        // $post = new Student($this->getDB());
        // $result = $post->delete($id);

        // if($result){
        //     return header("Location: /schl-hub/admin/student");
        // }
    }
}