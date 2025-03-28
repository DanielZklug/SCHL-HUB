<?php

// Définition du namespace pour cette classe
namespace App\Controllers;

// Importation de la classe DBConnexion du namespace Database
use App\Models\Post;
use Database\DBConnexion;
use App\Exceptions\NotFoundException;

// Définition de la classe Controller
abstract class Controller {

    // Propriété protégée pour stocker l'instance de connexion à la base de données
    protected $db;

    // Constructeur de la classe
    public function __construct(DBConnexion $db) {
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        // Initialisation de la propriété db avec l'instance de DBConnexion passée en paramètre
        $this->db = $db;
    }

    // Méthode pour rendre une vue
    protected function view(string $path, array $params = null) {
        // Démarre la mise en mémoire tampon de sortie
        ob_start();
        
        // Remplace les points par des séparateurs de répertoire dans le chemin de la vue
        $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
        
        // Inclut le fichier de vue spécifié
        require VIEWS . $path . '.php';
        
        // Récupère le contenu de la mémoire tampon et la vide
        $content = ob_get_clean();
        
        // Inclut le fichier de mise en page principal
        require VIEWS . 'layout.php';
    }
    protected function viewAdmin(?string $path = null, array $params = null) {
        // Démarre la mise en mémoire tampon de sortie
        ob_start();
        
        
        // Remplace les points par des séparateurs de répertoire dans le chemin de la vue
        $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
    
        // Inclut le fichier de vue spécifié
        require VIEWS . $path . '.php';
        
        
        // Récupère le contenu de la mémoire tampon et la vide
        $content = ob_get_clean();
        
        // Inclut le fichier de mise en page principal
        require VIEWS . 'adminlayout.php';

    }

    protected function viewStudent(?string $path = null, array $params = null) {
        // Démarre la mise en mémoire tampon de sortie
        ob_start();
        
        
        // Remplace les points par des séparateurs de répertoire dans le chemin de la vue
        $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
    
        // Inclut le fichier de vue spécifié
        require VIEWS . $path . '.php';
        
        
        // Récupère le contenu de la mémoire tampon et la vide
        $content = ob_get_clean();
        
        // Inclut le fichier de mise en page principal
        require VIEWS . 'studentlayout.php';

    }

    protected function viewLogin(string $path, array $params = null) {
        // Démarre la mise en mémoire tampon de sortie
        ob_start();
        
        // Remplace les points par des séparateurs de répertoire dans le chemin de la vue
        $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
        
        // Inclut le fichier de vue spécifié
        require VIEWS . $path . '.php';
        
        // Récupère le contenu de la mémoire tampon et la vide
        $content = ob_get_clean();
        
        // Inclut le fichier de mise en page principal
        require VIEWS . 'loginlayout.php';
    }

    protected function getDB(){
        return $this->db;
    }

    protected function isAdmin(){
        if(isset($_SESSION['admin']) && isset($_SESSION['idEncUser']) && $_SESSION['admin'] === 'encadrant'){
            return true;
        }else{
            return header("Location: /schl-hub/authentification");
        }
    }
    
    protected function isStudent(){
        if(isset($_SESSION['user']) && isset($_SESSION['idStaUser']) && $_SESSION['user'] === 'etudiant'){
            return true;
        }else{
            return header("Location: /schl-hub/authentification");
        }
    }
}