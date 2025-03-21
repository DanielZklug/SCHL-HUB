<?php

namespace App\Controllers\Admin;

use App\Models\Post;
use App\Models\Student;
use App\Controllers\Controller;
use App\Exceptions\NotFoundException;

class StudentController extends Controller{
    
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

        return $this->viewAdmin('admin.student.index',compact('post'));
    }

    public function create(){
        $this->isAdmin();

        if (!is_numeric($_SESSION['user']) || floor($_SESSION['user']) != $_SESSION['user']) {
            throw new NotFoundException("L'identifiant du post doit être un entier.");
        }

        $_SESSION['user'] = (int)$_SESSION['user']; // Conversion explicite en entier
        $post = new Student($this->getDB());
        $posts = $post->allStudent($_SESSION['user']);

        if (!$posts) {
            throw new NotFoundException("Aucun post trouvé avec l'identifiant : $_SESSION[user]");
        }

        return $this->viewAdmin('admin.student.index',compact('posts'));
    }
    public function show($id) {
        $this->isAdmin();
    
        // if (!is_numeric($id) || floor($id) != $id) {
        //     throw new NotFoundException("L'identifiant du post doit être un entier.");
        // }

        // $id = (int)$id; // Conversion explicite en entier
        // $post = new Student($this->getDB());
        // $post = $post->findById($id);

        // if (!$post) {
        //     throw new NotFoundException("Aucun post trouvé avec l'identifiant : $id");
        // }

        return $this->viewAdmin('admin.student.show');
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