<?php

namespace App\Controllers\Admin;

use App\Models\Course;
use App\Models\Post;
use App\Models\Student;
use App\Controllers\Controller;
use App\Exceptions\NotFoundException;

class SupportController extends Controller{
    
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
        $support = (new Course($this->getDB()))->getCoursesByExtension("",$_SESSION['idEncadrant'],);
        $supportPdf = (new Course($this->getDB()))->getCoursesByExtension("pdf",$_SESSION['idEncadrant']);
        $supportDocx = (new Course($this->getDB()))->getCoursesByExtension("docx",$_SESSION['idEncadrant']);
        $supportPptx = (new Course($this->getDB()))->getCoursesByExtension("pptx",$_SESSION['idEncadrant']);
        
        return $this->viewAdmin('admin.support.index',compact('post','support', 'supportPdf','supportDocx', 'supportPptx'));
    }
    public function delete($id) {
        $this->isAdmin();

        if (!is_numeric($id) || floor($id) != $id) {
            throw new NotFoundException("L'identifiant du support doit être un entier.");
        }

        $course = new Course($this->getDB());
        $result = $course->delete($id);

        if ($result) {
            $_SESSION['success_message'] = "Support supprimé avec succès.";
        } else {
            $_SESSION['error_message'] = "Erreur lors de la suppression du support.";
        }

        return header("Location: /schl-hub/admin/support");
    }
}