<?php

namespace App\Controllers\Admin;

session_start();

use App\Models\Classe;
use App\Models\Post;
use App\Models\Student;
use App\Controllers\Controller;
use App\Exceptions\NotFoundException;

class ClassController extends Controller{

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

        // Appelle la fonction pour récupérer les classes
        $classes = (new Classe($this->getDB()))->getClassesByEncadrant($_SESSION['idEncUser']);

        return $this->viewAdmin('admin.classroom.index',compact('post','classes'));
    }

    public function createClass(){
        $this->isAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validation des entrées
            $data = [
                'idEncUser' => $_SESSION['idEncUser'],
                'idEnc' => $_SESSION['idEncadrant'],
                'nom_classe' => $_POST['nom_classe'],
                'stagiaire_email' => $_POST['stagiaire_email']
            ];

            try {
                $class = new Classe($this->getDB());
                $result = $class->createClass($data);

                if ($result) {
                    $_SESSION['success_message'] = "Nouvelle classe créée";
                    return header("Location: /schl-hub/admin/classroom");
                } 
                else {
                    $_SESSION['error_message'] = "Une erreur est survenue lors de la création de la classe";
                    return header("Location: /schl-hub/admin/classroom");
                }
            } catch (\Exception $e) {
                $_SESSION['error_message'] = "Une erreur est survenue: " . $e->getMessage();
                return header("Location: /schl-hub/admin/classroom");
            }
        }


    }

    public function show(int $id) {
        $this->isAdmin(); // Vérifie si l'utilisateur est un administrateur

        if (!is_numeric($_SESSION['idEncUser']) || floor($_SESSION['idEncUser']) != $_SESSION['idEncUser']) {
            throw new NotFoundException("L'identifiant du post doit être un entier.");
        }

        $_SESSION['idEncUser'] = (int)$_SESSION['idEncUser']; // Conversion explicite en entier
        $post = new Post($this->getDB());
        $post = $post->findProfil($_SESSION['idEncUser']);

        if (!$post) {
            throw new NotFoundException("Aucun post trouvé avec l'identifiant : $_SESSION[idEncUser]");
        }
        
        // Appelle la méthode pour récupérer les informations de la classe
        $class = (new Classe($this->getDB()))->getClassById($id);
    
        // Retourne la vue avec les informations de la classe
        return $this->viewAdmin('admin.classroom.show', compact('post','class'));
    }
}