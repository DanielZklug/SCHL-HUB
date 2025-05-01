<?php

namespace App\Controllers\Student;

use App\Models\Post;
use App\Models\Student;
use App\Models\Reminder;
use App\Controllers\Controller;
use App\Exceptions\NotFoundException;

class CalendarController extends Controller{

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
        $rappel = new Reminder($this->getDB());
        $rappels = $rappel->getRemindersByUserId($_SESSION['idStaUser']);

        return $this->viewStudent('student.calendar.index',compact('post', 'rappels'));
    }

    public function show($id) {
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

        $rappels = new Reminder($this->getDB());
        $rappel = $rappels->getRemindersById($id);

        return $this->viewStudent('student.calendar.show', compact('post', 'rappel'));
    }

    public function store() {
        // Vérifier si la méthode est POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'reminder_title' => $_POST['reminder_title'],
                'reminder_description' => $_POST['reminder_description'],
                'reminder_date' => $_POST['reminder_date'],
                'user_id' => $_POST['user_id']
            ];

            $reminder = new Reminder($this->getDB());
            $result = $reminder->createReminder($data);

            if ($result) {
                $_SESSION['success_message'] = "Rappel créé avec succès.";
            } else {
                $_SESSION['error_message'] = "Erreur lors de la création du rappel.";
            }

            // Rediriger vers la page précédente ou une autre page
            return header("Location: /schl-hub/student/calendar");
        }

        // Si la méthode n'est pas POST, rediriger
        $_SESSION['error_message'] = "Méthode de requête invalide.";
        return header("Location: /schl-hub/student/calendar");
    }

    public function delete($id){
        $this->isStudent();

        $post = new Reminder($this->getDB());
        $result = $post->delete($id);

        if($result){
            $_SESSION['success_message'] = "Rappel supprimé avec succès";
            return header("Location: /schl-hub/student/calendar");
        }
    }


}