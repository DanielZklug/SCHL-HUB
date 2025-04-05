<?php

namespace App\Controllers\Admin;

use App\Models\Post;
use App\Models\Message;
use App\Models\Student;
use App\Controllers\Controller;
use App\Exceptions\NotFoundException;

class LetterController extends Controller{

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

        $posts = new Message($this->getDB());
        $all = $posts->allMessage($_SESSION['idEncUser']);

        return $this->viewAdmin('admin.emails.index',compact('post', 'all'));
    }
    public function show($id){
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

        $posts = new Message($this->getDB());
        $message = $posts->seeMessage($id);

        return $this->viewAdmin('admin.emails.show',compact('post', 'message'));
    }

    public function delete($id){
        $this->isAdmin();

        $post = new Message($this->getDB());
        $result = $post->delete($id);

        if($result){
            $_SESSION['success_message'] = "lettre supprimé avec succès";
            return header("Location: /schl-hub/admin/emails");
        }
    }

}