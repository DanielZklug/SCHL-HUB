<?php
// Définition du namespace pour cette classe
namespace App\Controllers;

session_start();


use App\Models\Post;
use App\Models\User;


class UserController extends Controller{
    
    public function login(){
        return $this->viewLogin('authentification.login');
    }

    public function loginPost(){
        $user = (new User($this->getDB()))->getByUsername($_POST['email']);
        if($user && password_verify($_POST['password'], $user->motPasse)){
            if($user->role === "encadrant"){
                $_SESSION['idEncUser'] = $user->idUtilisateur;
                $_SESSION['admin'] = $user->role;
                // Récupérer les informations du post lié à l'encadrant
                $idEnc = (new Post($this->getDB()))->getIdEncadrantByUserId($_SESSION['idEncUser']);
                if ($idEnc) {
                    $_SESSION['idEncadrant'] = $idEnc; // Stocker les informations du post dans la session
                }
                $_SESSION['success_message'] = "Vous êtes connecté";
                return header("Location: /schl-hub/admin/dashboard");
            }else{
                $_SESSION['idStaUser'] = $user->idUtilisateur;
                $_SESSION['user'] = $user->role;
                $_SESSION['success_message'] = "Vous êtes connecté";
                return header("Location: /schl-hub/student/dashboard");
            }
        }else{
            $_SESSION['error_message'] = "Mot de passe ou email incorrect. Veuillez réessayer.";
            
            return header("Location: /schl-hub/authentification");
        }
    }

    public function logoutAdmin(){
        // Unset the session variable for the encadrant user
        unset($_SESSION['idEncUser']);
        unset($_SESSION['admin']);
        
        // Optionally, destroy the entire session
        // session_destroy();

        // Redirect to the login page or any other page
        return header("Location: /schl-hub/authentification");
    }
    public function logoutUser(){
        // Unset the session variable for the encadrant user
        unset( $_SESSION['idStaUser']);
        unset($_SESSION['user']);
        
        // Optionally, destroy the entire session
        // session_destroy();

        // Redirect to the login page or any other page
        return header("Location: /schl-hub/authentification");
    }

}