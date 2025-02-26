<?php

namespace App\Controllers;

use App\Models\Post; // Assurez-vous que cette classe existe dans App\Models
use App\Exceptions\NotFoundException;

// Définition de la classe BlogController qui étend la classe Controller
class BlogController extends Controller {

    // Méthode pour afficher la page d'accueil du blog
    public function welcome() {
        // Exécute une requête SQL pour récupérer les utilisateurs et leurs profils, triés par ID d'utilisateur décroissant
        $stmt = $this->db->getPDO()->query("
            SELECT 
                utilisateurs.id AS utilisateur_id,
                utilisateurs.nom,
                utilisateurs.prenom,
                profil_utilisateurs.photo,
                profil_utilisateurs.profession
            FROM 
                utilisateurs
            JOIN 
                profil_utilisateurs ON utilisateurs.id = profil_utilisateurs.id_utilisateur
            ORDER BY 
                utilisateurs.id DESC
            LIMIT 6
        ");
        
        // Récupère tous les résultats de la requête
        $posts = $stmt->fetchAll();
        
        // Retourne la vue 'blog.welcome' en passant les posts récupérés
        return $this->view('blog.welcome', compact('posts'));
    }
    
    // Méthode pour afficher la liste des posts du blog
    public function index() {
        
        $post = new Post($this->getDB()); // Assurez-vous que le constructeur de Post prend un paramètre valide
        $posts = $post->all(); // Récupère tous les posts
        
        // Retourne la vue 'blog.index' en passant les posts récupérés
        return $this->view('blog.index', compact('posts'));
    }

    public function test(){
        return $this->view('tests.index');
    }

    public function show($id) {
        if (!is_numeric($id) || floor($id) != $id) {
            throw new NotFoundException("L'identifiant du post doit être un entier.");
        }

        $id = (int)$id; // Conversion explicite en entier
        $post = new Post($this->getDB());
        $post = $post->findById($id);

        if (!$post) {
            throw new NotFoundException("Aucun post trouvé avec l'identifiant : $id");
        }

        return $this->view('blog.show', compact('post'));
    }
}
