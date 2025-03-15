<?php

namespace App\Controllers;

use App\Models\Post; // Assurez-vous que cette classe existe dans App\Models
use App\Exceptions\NotFoundException;
use App\Models\User;

// Définition de la classe BlogController qui étend la classe Controller
class BlogController extends Controller {

    // Méthode pour afficher la page d'accueil du blog
    public function welcome() {
        // Exécute une requête SQL pour récupérer les utilisateurs et leurs profils, triés par ID d'utilisateur décroissant
        $stmt = $this->db->getPDO()->query("
            SELECT 
                *
            FROM 
                encadrants
            ORDER BY 
                id DESC
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

    public function create(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom' => $_POST['nom'],
                'prenom' => $_POST['prenom'],
                'numero' => $_POST['numero'],
                'email' => $_POST['email1'],
                'email2' => $_POST['email2'],
                'mot_passe' => password_hash($_POST['mot_passe'], PASSWORD_DEFAULT),
                'role' => $_POST['role'] // 'encadrant' ou 'etudiant'
            ];
            
            $post = new User($this->getDB());
            $result = $post->create($data);

            if ($result && $data['role'] === 'encadrant') {
                // Inscription réussie
                // Rediriger vers une page de succès ou afficher un message
                return header ("Location: /schl-hub/admin/profile");
            } elseif($result && $data['role'] === 'etudiant') {
                // Erreur lors de l'inscription
                // Rediriger vers le formulaire avec un message d'erreur
                return $this->viewAdmin('admin.dashboard.index');
            }else{
                return "Error";
            }
        }

        // Si ce n'est pas une requête POST, affichez le formulaire d'inscription
        return $this->view('blog.create');
    }
}
