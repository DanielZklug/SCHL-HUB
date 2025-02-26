<?php

// Définition du namespace pour cette classe
namespace App\Controllers;

// Importation de la classe DBConnexion du namespace Database
use Database\DBConnexion;

// Définition de la classe Controller
abstract class Controller {

    // Propriété protégée pour stocker l'instance de connexion à la base de données
    protected $db;

    // Constructeur de la classe
    public function __construct(DBConnexion $db) {
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

    protected function getDB(){
        return $this->db;
    }
}