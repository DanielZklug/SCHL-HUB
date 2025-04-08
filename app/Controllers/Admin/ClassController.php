<?php

namespace App\Controllers\Admin;

use App\Models\Course;
use App\Models\Classe;
use App\Models\Post;
use App\Models\Student;
use App\Controllers\Controller;
use App\Exceptions\NotFoundException;

session_start();

class ClassController extends Controller {

    public function index() {
        $this->isAdmin();

        if (!isset($_SESSION['idEncUser']) || !is_numeric($_SESSION['idEncUser'])) {
            throw new NotFoundException("L'identifiant du post doit être un entier.");
        }

        $_SESSION['idEncUser'] = (int) $_SESSION['idEncUser'];
        $post = (new Post($this->getDB()))->findProfil($_SESSION['idEncUser']);

        if (!$post) {
            throw new NotFoundException("Aucun post trouvé avec l'identifiant : $_SESSION[idEncUser]");
        }

        $classes = (new Classe($this->getDB()))->getClassesByEncadrant($_SESSION['idEncUser']);
        return $this->viewAdmin('admin.classroom.index', compact('post', 'classes'));
    }

    public function createClass() {
        $this->isAdmin();
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'idEncUser' => $_SESSION['idEncUser'],
                'idEnc' => $_SESSION['idEncadrant'],
                'nom_classe' => $_POST['nom_classe'],
                'stagiaire_email' => $_POST['stagiaire_email']
            ];

            try {
                $class = new Classe($this->getDB());
                $result = $class->createClass($data);

                $_SESSION[$result ? 'success_message' : 'error_message'] = $result 
                    ? "Nouvelle classe créée avec succès." 
                    : "Une erreur est survenue lors de la création de la classe.";
                return header("Location: /schl-hub/admin/classroom");
            } catch (\Exception $e) {
                error_log("Erreur dans ClassController::createClass : " . $e->getMessage(), 3, __DIR__ . '/../../logs/errors.log');
                $_SESSION['error_message'] = "Une erreur est survenue : " . $e->getMessage();
                return header("Location: /schl-hub/admin/classroom");
            }
        }
    }

    public function show($id) {
        $this->isAdmin();

        if (!is_numeric($id)) {
            throw new NotFoundException("L'identifiant du post doit être un entier.");
        }

        $_SESSION['idEncUser'] = (int) $_SESSION['idEncUser'];
        $post = (new Post($this->getDB()))->findProfil($_SESSION['idEncUser']);

        if (!$post) {
            throw new NotFoundException("Aucun post trouvé avec l'identifiant : $_SESSION[idEncUser]");
        }

        $class = (new Classe($this->getDB()))->getClassById($id);
        return $this->viewAdmin('admin.classroom.show', compact('post', 'class'));
    }

    public function publish($id) {
        $this->isAdmin();
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_FILES['file']) && $this->publishFile($id)) {
                $_SESSION['success_message'] = "Fichier publié avec succès.";
                return header("Location: /schl-hub/admin/classroom");
            }

            if (isset($_POST['email_stagiaire']) && $this->insertData($id)) {
                return header("Location: /schl-hub/admin/classroom");
            }

            $_SESSION['error_message'] = "Échec de l'opération.";
            return header("Location: /schl-hub/admin/classroom");
        }

        $_SESSION['error_message'] = "Méthode de requête invalide.";
        return header("Location: /schl-hub/admin/classroom");
    }

    public function publishFile($id) {
        $this->isAdmin();

        if (empty($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            $_SESSION['error_message'] = "Aucun fichier téléchargé ou erreur lors du téléchargement.";
            return false;
        }

        $file = $_FILES['file'];
        $allowedTypes = [
            'application/pdf' => 'pdf',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
            'application/msword' => 'doc',
            'application/vnd.ms-powerpoint' => 'ppt',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'pptx'
        ];
        $maxSize = 5 * 1024 * 1024;

        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $fileType = $file['type'];

        if (!array_key_exists($fileType, $allowedTypes) || $file['size'] > $maxSize) {
            $_SESSION['error_message'] = "Type de fichier non valide ou fichier trop volumineux.";
            return false;
        }

        $subDir = $allowedTypes[$fileType];
        $uploadDir = __DIR__ . "/../../../public/$subDir/";

        if (!is_dir($uploadDir) && !mkdir($uploadDir, 0777, true)) {
            $_SESSION['error_message'] = "Impossible de créer le répertoire de téléchargement.";
            return false;
        }

        $uploadFile = $uploadDir . basename($file['name']);
        if (file_exists($uploadFile)) {
            $_SESSION['error_message'] = "Un fichier avec le même nom existe déjà dans le dossier $subDir.";
            return false;
        }

        if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
            $fileName = pathinfo($file['name'], PATHINFO_FILENAME);
            $fileExtension = $extension;

            $Cours = new Course($this->getDB());
            if ($Cours->insertCourse($_SESSION['idEncadrant'], $id, $fileName, $fileExtension)) {
                $_SESSION['success_message'] = "Cours publié.";
                return true;
            }
        }

        $_SESSION['error_message'] = "Échec de la publication du fichier.";
        return false;
    }

    public function insertData(int $id) {
        $this->isAdmin();

        $data = [
            'idEnc' => $_SESSION['idEncadrant'],
            'idCla' => $id,
            'stagiaire_email' => $_POST['email_stagiaire'] ?? null
        ];

        if (empty($data['stagiaire_email'])) {
            $_SESSION['error_message'] = "Tous les champs obligatoires doivent être remplis.";
            return false;
        }

        $classModel = new Student($this->getDB());
        if ($classModel->insertStudent($data)) {
            $_SESSION['success_message'] = "Classe insérée avec succès.";
            return true;
        }

        $_SESSION['error_message'] = "Erreur lors de l'insertion de la classe.";
        return false;
    }

    public function delete(int $id) {
        $this->isAdmin();

        $post = new Classe($this->getDB());
        if ($post->delete($id)) {
            $_SESSION['success_message'] = "Classe supprimée avec succès.";
            return header("Location: /schl-hub/admin/classroom");
        }
    }
}
