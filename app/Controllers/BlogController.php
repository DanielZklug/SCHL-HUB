<?php
namespace App\Controllers;

session_start();

use App\Models\Post;
use App\Exceptions\NotFoundException;
use App\Models\User;

class BlogController extends Controller {

    public function welcome() {
        $stmt = $this->db->getPDO()->query("
            SELECT
                e.idEncadrant, 
                u.nom AS nom_utilisateur, 
                u.prenom AS prenom_utilisateur,  
                u.photo AS photo_utilisateur, 
                e.profession AS profession_encadrant
            FROM
                encadrant e
            JOIN utilisateur u ON e.Uti_idUtilisateur = u.idUtilisateur
            ORDER BY e.idEncadrant DESC
            LIMIT 6;
        ");
        
        $posts = $stmt->fetchAll();
        return $this->view('blog.welcome', compact('posts'));
    }
    
    public function index() {
        $post = new Post($this->getDB());
        $posts = $post->all();
        return $this->view('blog.index', compact('posts'));
    }

    public function show($id) {
        if (!is_numeric($id) || floor($id) != $id) {
            throw new NotFoundException("L'identifiant du post doit être un entier.");
        }

        $id = (int)$id;
        $post = new Post($this->getDB());
        $post = $post->findById($id);

        if (!$post) {
            throw new NotFoundException("Aucun post trouvé avec l'identifiant : $id");
        }

        return $this->view('blog.show', compact('post'));
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validation des entrées
            $data = [
                'nom' => filter_var(trim($_POST['nom']), FILTER_SANITIZE_STRING),
                'prenom' => filter_var(trim($_POST['prenom']), FILTER_SANITIZE_STRING),
                'mot_passe' => password_hash($_POST['mot_passe'], PASSWORD_DEFAULT),
                'numero' => filter_var(trim($_POST['numero']), FILTER_SANITIZE_STRING),
                'email' => filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL),
                'role' => filter_var(trim($_POST['role']), FILTER_SANITIZE_STRING)
            ];

            // Vérification de l'email
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error_message'] = "Adresse email invalide.";
                return $this->view('blog.welcome');
            }

            try {
                $user = new User($this->getDB());
                $result = $user->create($data);

                if ($result) {
                    $_SESSION['success_message'] = "Inscription réussie. Veuillez vous connecter.";
                    return header("Location: /schl-hub/authentification");
                } else {
                    return $this->view('blog.welcome');
                }
            } catch (\Exception $e) {
                $_SESSION['error_message'] = "Une erreur est survenue: " . $e->getMessage();
                return $this->view('blog.welcome');
            }
        }
    }
}
