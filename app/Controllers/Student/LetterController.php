<?php
namespace App\Controllers\Student;

use App\Models\Post;
use App\Models\Message;
use App\Models\Student;
use App\Controllers\Controller;
use App\Exceptions\NotFoundException;

class LetterController extends Controller{

    public function index(){
        $this->isStudent();
        if (!is_numeric($_SESSION['idStaUser']) || floor($_SESSION['idStaUser']) != $_SESSION['idStaUser']) {
            throw new NotFoundException("L'identifiant du post doit être un entier.");
        }

        $_SESSION['idStaUser'] = (int)$_SESSION['idStaUser']; // Conversion explicite en entier
        $post = new Post($this->getDB());
        $post = $post->findByIdStagiaire($_SESSION['idStaUser']);

        if (!$post) {
            throw new NotFoundException("Aucun post trouvé avec l'identifiant : $_SESSION[idStaUser]");
        }
        
        $posts = new Message($this->getDB());
        $all = $posts->allMessage($_SESSION['idStaUser']);

        return $this->viewStudent('student.emails.index',compact('post', 'all'));
    }

    public function show($id){
        $this->isStudent();
        if (!is_numeric($_SESSION['idStaUser']) || floor($_SESSION['idStaUser']) != $_SESSION['idStaUser']) {
            throw new NotFoundException("L'identifiant du post doit être un entier.");
        }

        $_SESSION['idStaUser'] = (int)$_SESSION['idStaUser']; // Conversion explicite en entier
        $post = new Post($this->getDB());
        $post = $post->findByIdStagiaire($_SESSION['idStaUser']);

        if (!$post) {
            throw new NotFoundException("Aucun post trouvé avec l'identifiant : $_SESSION[idStaUser]");
        }

        $posts = new Message($this->getDB());
        $message = $posts->seeMessage($id);

        return $this->viewStudent('student.emails.show',compact('post', 'message'));
    }

    public function delete($id){
        $this->isStudent();

        $post = new Message($this->getDB());
        $result = $post->delete($id);

        if($result){
            $_SESSION['success_message'] = "lettre supprimé avec succès";
            return header("Location: /schl-hub/student/emails");
        }
    }

}