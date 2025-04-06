<?php

namespace App\Controllers\Admin;

use App\Models\Post;
use App\Models\Search;
use App\Models\Student;
use App\Controllers\Controller;
use App\Exceptions\NotFoundException;

class SearchController extends Controller{

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

        $query = isset($_GET['query']) ? trim($_GET['query']) : '';
        if (empty($query)) {
            throw new NotFoundException("Le paramètre de recherche est manquant ou vide.");
        }

        $searchModel = new Search($this->getDB());
        $results = $searchModel->performSearch($query,$_SESSION['idEncadrant']);

        return $this->viewAdmin('admin.search.index',compact('post', 'results', 'query'));
    }

}