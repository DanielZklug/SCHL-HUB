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
                e.idEncadrant, 
                u.nom AS nom_utilisateur, 
                u.prenom AS prenom_utilisateur, 
                u.numero AS numero_utilisateur, 
                u.email AS email_utilisateur, 
                u.photo AS photo_utilisateur, 
                ps.gitlab, 
                ps.github, 
                ps.facebook, 
                ps.instagram, 
                ps.google, 
                e.emailOrg AS email_organisationnel,
                e.bio AS bio_encadrant
            FROM
                Encadrant e
            JOIN Utilisateur u ON e.Uti_idUtilisateur = u.idUtilisateur
            JOIN ProfilSocial ps ON e.idPsocial = ps.idPsocial
            ORDER BY e.idEncadrant DESC
            LIMIT 6;
            -- Limite les résultats à 6

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
                'mot_passe' => password_hash($_POST['mot_passe'], PASSWORD_DEFAULT),
                'numero' => $_POST['numero'],
                'email' => $_POST['email'],
                'role' => $_POST['role'] // 'encadrant' ou 'etudiant'
            ];
            
            $post = new User($this->getDB());
            $result = $post->create($data);

            if ($result && $data['role'] === 'encadrant') {
                // Inscription réussie
                $_SESSION['success_message'] = "Inscription réussie. Veuillez vous connecter.";
                return $this->viewLogin('authentification.login');
            } elseif ($result && $data['role'] === 'etudiant') {
                // Inscription réussie
                $_SESSION['success_message'] = "Inscription réussie. Veuillez vous connecter.";
                return $this->viewLogin('authentification.login');
            } else {
                // Erreur lors de l'inscription
                $_SESSION['error_message'] = "Erreur lors de l'inscription. Veuillez réessayer.";
                // Retourne la vue 'blog.welcome' en passant les posts récupérés
                return $this->view('blog.welcome');
            }
        }
    }
}
