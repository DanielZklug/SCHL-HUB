<?php

namespace App\Controllers;


class BlogController extends Controller{

    public function welcome(){
        return $this->view('blog.welcome');
    }
    
    public function index(){
        $stmt = $this->db->getPDO()->query("SELECT * FROM profil_utilisateurs ORDER BY id DESC");
        $posts = $stmt->fetchAll();
        return $this->view('blog.index',compact('posts'));
    }
    public function show(int $id){
        $stmt = $this->db->getPDO()->prepare("SELECT * FROM profil_utilisateurs WHERE id = ?");
        return $this->view('blog.show', compact('id'));
    }
}