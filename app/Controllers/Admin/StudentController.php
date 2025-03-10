<?php

namespace App\Controllers\Admin;

use App\Models\Student;
use App\Controllers\Controller;
use App\Exceptions\NotFoundException;

class StudentController extends Controller{
    
    public function index(){
        $posts = (new Student($this->getDB()))->allStudent();

        return $this->viewAdmin('admin.student.index',compact('posts'));
    }

    public function show($id) {
        if (!is_numeric($id) || floor($id) != $id) {
            throw new NotFoundException("L'identifiant du post doit être un entier.");
        }

        $id = (int)$id; // Conversion explicite en entier
        $post = new Student($this->getDB());
        $post = $post->findById($id);

        if (!$post) {
            throw new NotFoundException("Aucun post trouvé avec l'identifiant : $id");
        }

        return $this->viewAdmin('admin.student.show', compact('post'));
    }

    public function delete(int $id){
        $post = new Student($this->getDB());
        $result = $post->delete($id);

        if($result){
            return header("Location: /schl-hub/admin/student");
        }
    }
}