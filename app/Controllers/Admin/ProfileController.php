<?php

namespace App\Controllers\Admin;

use App\Models\User;

session_start();

use App\Models\Post;
use App\Models\Student;
use App\Controllers\Controller;
use App\Exceptions\NotFoundException;

class ProfileController extends Controller{
    
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

        return $this->viewAdmin('admin.profile.index',compact('post'));
    }
    
    public function updateProfile() {
        // Vérifiez si la requête est une soumission de formulaire
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Vérifiez si le formulaire de mise à jour de la photo de profil a été soumis
            if (isset($_FILES['file'])) {
                $this->uploadProfileImage();
            }

            // Vérifiez si le formulaire de mise à jour des informations de compte a été soumis
            if (isset($_POST['email_organisationnel'])) {
                $this->updateAccountInformation();
            }

            // Vérifiez si le formulaire de mise à jour des profils sociaux a été soumis
            if (isset($_POST['Facebook'])) {
                $this->updateSocialProfiles();
            }
        }
        
        // Redirigez vers la page de profil après le traitement
        header("Location: /schl-hub/admin/profile");
        exit;
    }

    public function uploadProfileImage() {
        if (empty($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            $_SESSION['error_message'] = "Aucun fichier téléchargé ou erreur lors du téléchargement.";
            return;
        }
    
        $file = $_FILES['file'];
        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $maxSize = 400 * 1024; // 400 Ko
    
        // Validation du fichier
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($file['type'], $allowedTypes) || $file['size'] > $maxSize || !in_array($extension, $allowedExtensions)) {
            $_SESSION['error_message'] = "Type de fichier non valide ou fichier trop volumineux.";
            return;
        }
    
        // Définir le répertoire de téléchargement
        $uploadDir = __DIR__ . '/../../../public/uploads/';
        $_SESSION['file_name'] = $file['name'];
    
        // Vérification du répertoire
        if (!is_dir($uploadDir)) {
            $_SESSION['error_message'] = "Répertoire de téléchargement non accessible.";
            return;
        }
    
        $uploadFile = $uploadDir . basename($file['name']);
    
        // Vérifier si le fichier existe déjà
        if (file_exists($uploadFile)) {
            $_SESSION['error_message'] = "Un fichier avec ce nom existe déjà. Le fichier ne sera pas déplacé.";
            $post = new User($this->getDB());
            if ($post->insertFile($_SESSION["user"])) {
                $_SESSION['success_message'] = "Image de profil mise à jour avec succès.";
            } else {
                $_SESSION['error_message'] = "Erreur lors de l'enregistrement des informations du fichier.";
            }
        } else {
            if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
                $_SESSION['success_message'] = "Image de profil mise à jour avec succès.";
    
                if (!isset($_SESSION["user"])) {
                    $_SESSION['error_message'] = "Utilisateur non connecté.";
                    return;
                }
    
                $post = new User($this->getDB());
                if ($post->insertFile($_SESSION["user"])) {
                    $_SESSION['success_message'] = "Image de profil mise à jour avec succès.";
                } else {
                    $_SESSION['error_message'] = "Erreur lors de l'enregistrement des informations du fichier.";
                }
            } else {
                $_SESSION['error_message'] = "Échec de la mise à jour de l'image de profil.";
            }
        }
    }
    
    
    
    
    

    public function updateAccountInformation() {
        // Récupérer et valider les données du formulaire
        $data = [
            'email_organisationnel' => $_POST['email_organisationnel'],
            'profession_encadrant' => $_POST['profession_encadrant'],
            'bio_encadrant' => $_POST['bio_encadrant']
        ];
        

        $post = new Post($this->getDB());
        if ($post->update($_SESSION["user"],$data)) {
            $_SESSION['success_message'] = "Profil mise à jour avec succès.";
        } else {
            $_SESSION['error_message'] = "Erreur lors de l'enregistrement des informations du fichier.";
        }
    }

    private function updateSocialProfiles() {
        // Récupérer et valider les données des profils sociaux
        $facebook = $_POST['Facebook'];
        $instagram = $_POST['Instagram'];
        $google = $_POST['Google'];
        $github = $_POST['Github'];
        $gitlab = $_POST['Gitlab'];

        // Ici, vous devriez mettre à jour les informations dans la base de données
        // Exemple :
        // $this->model->updateSocialProfiles($facebook, $instagram, $google, $github, $gitlab);

        $_SESSION['success_message'] = "Profils sociaux mis à jour avec succès.";
    }

}