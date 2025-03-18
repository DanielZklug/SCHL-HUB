<?php
// Définition du namespace pour cette classe
namespace App\Controllers;


use App\Controllers\Controller;


class UserController extends Controller{
    
    public function login(){
        return $this->viewLogin('authentification.login');
    }

}