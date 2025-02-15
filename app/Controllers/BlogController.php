<?php

namespace App\Controllers;


class BlogController extends Controller{
    
    public function index(){
        return $this->view('blog.index');
    }
    public function show(int $id){
        $query= $this->db->getPDO()->query("SELECT * FROM user");
        $user = $query->fetchAll();
        foreach($user as $utilisateur){
          echo  $utilisateur->nom;
        }
        return $this->view('blog.show', compact('id'));
    }
}