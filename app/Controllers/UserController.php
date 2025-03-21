<?php
// Définition du namespace pour cette classe
namespace App\Controllers;

session_start();


use App\Models\User;


class UserController extends Controller{
    
    public function login(){
        return $this->viewLogin('authentification.login');
    }

    public function loginPost(){
        $user = (new User($this->getDB()))->getByUsername($_POST['email']);
        if($user && password_verify($_POST['password'], $user->motPasse)){
            $_SESSION['user'] = $user->idUtilisateur;
            $_SESSION['admin'] = $user->role;
            if($user->role === "encadrant"){
                $_SESSION['success_message'] = "Vous êtes connecté";
                return header("Location: /schl-hub/admin/dashboard");
            }else{
                return header("Location: /schl-hub/student/dashboard");
            }
        }else{
            $_SESSION['error_message'] = "Mot de passe ou email incorrect. Veuillez réessayer.";
            return header("Location: /schl-hub/authentification");
        }
    }

}