<?php

namespace App\Controllers\Admin;

use App\Models\Course;

session_start();

use App\Models\Classe;
use App\Models\Post;
use App\Models\Student;
use App\Controllers\Controller;
use App\Exceptions\NotFoundException;

class ClassController extends Controller {

    public function index() {
        $this->isAdmin();

        // Vérification de l'ID utilisateur dans la session
        if (!isset($_SESSION['idEncUser']) || !is_numeric($_SESSION['idEncUser']) || floor($_SESSION['idEncUser']) != $_SESSION['idEncUser']) {
            throw new NotFoundException("L'identifiant du post doit être un entier.");
        }

        $_SESSION['idEncUser'] = (int) $_SESSION['idEncUser']; // Conversion explicite en entier
        $post = new Post($this->getDB());
        $post = $post->findProfil($_SESSION['idEncUser']);

        if (!$post) {
            throw new NotFoundException("Aucun post trouvé avec l'identifiant : $_SESSION[idEncUser]");
        }

        // Appel pour récupérer les classes
        $classes = (new Classe($this->getDB()))->getClassesByEncadrant($_SESSION['idEncUser']);

        return $this->viewAdmin('admin.classroom.index', compact('post', 'classes'));
    }

    public function createClass() {
        $this->isAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validation des entrées
            $data = [
                'idEncUser' => $_SESSION['idEncUser'],
                'idEnc' => $_SESSION['idEncadrant'],
                'nom_classe' => $_POST['nom_classe'] ?? null,
                'stagiaire_email' => $_POST['stagiaire_email'] ?? null
            ];

            // Vérification des données nécessaires
            if (empty($data['nom_classe']) || empty($data['stagiaire_email'])) {
                $_SESSION['error_message'] = "Tous les champs obligatoires doivent être remplis.";
                return header("Location: /schl-hub/admin/classroom");
            }

            try {
                $class = new Classe($this->getDB());
                $result = $class->createClass($data);

                if ($result) {
                    $_SESSION['success_message'] = "Nouvelle classe créée";
                } else {
                    $_SESSION['error_message'] = "Une erreur est survenue lors de la création de la classe";
                }
                return header("Location: /schl-hub/admin/classroom");
            } catch (\Exception $e) {
                $_SESSION['error_message'] = "Une erreur est survenue: " . $e->getMessage();
                return header("Location: /schl-hub/admin/classroom");
            }
        }
    }

    public function show(int $id) {
        $this->isAdmin(); // Vérifie si l'utilisateur est un administrateur

        // Vérification de l'ID utilisateur dans la session
        if (!isset($_SESSION['idEncUser']) || !is_numeric($_SESSION['idEncUser']) || floor($_SESSION['idEncUser']) != $_SESSION['idEncUser']) {
            throw new NotFoundException("L'identifiant du post doit être un entier.");
        }

        $_SESSION['idEncUser'] = (int) $_SESSION['idEncUser']; // Conversion explicite en entier
        $post = new Post($this->getDB());
        $post = $post->findProfil($_SESSION['idEncUser']);

        if (!$post) {
            throw new NotFoundException("Aucun post trouvé avec l'identifiant : $_SESSION[idEncUser]");
        }

        // Appel pour récupérer les informations de la classe
        $class = (new Classe($this->getDB()))->getClassById($id);

        // Retourne la vue avec les informations de la classe
        return $this->viewAdmin('admin.classroom.show', compact('post', 'class'));
    }

    public function publish() {
        $this->isAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Vérifiez si un fichier a été soumis
            if (isset($_FILES['file']) && $this->publishFile()) {
                return header("Location: /schl-hub/admin/classroom");
            }

            // Vérifiez si des données doivent être insérées
            if (isset($_POST['email_stagiaire']) && $this->insertData()) {
                return header("Location: /schl-hub/admin/classroom");
            }
        }

        // Redirigez en cas d'erreur
        $_SESSION['error_message'] = "Échec de la publication du fichier.";
        return header("Location: /schl-hub/admin/classroom");
    }

    public function publishFile() {
        $this->isAdmin();

        if (empty($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            $_SESSION['error_message'] = "Aucun fichier téléchargé ou erreur lors du téléchargement.";
            return false;
        }

        $file = $_FILES['file'];
        $allowedTypes = [
            'application/pdf' => 'pdf',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'word', // Word (docx)
            'application/msword' => 'word', // Word (doc)
            'application/vnd.ms-powerpoint' => 'powerpoint', // PowerPoint (ppt)
            'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'powerpoint' // PowerPoint (pptx)
        ];
        $maxSize = 5 * 1024 * 1024; // 5 Mo

        // Validation du fichier
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $fileType = $file['type'];

        if (!array_key_exists($fileType, $allowedTypes) || $file['size'] > $maxSize) {
            $_SESSION['error_message'] = "Type de fichier non valide ou fichier trop volumineux.";
            return false;
        }

        // Définir le répertoire de téléchargement en fonction du type de fichier
        $subDir = $allowedTypes[$fileType]; // Récupère le sous-dossier (pdf, word, powerpoint)
        $uploadDir = __DIR__ . "/../../../public/$subDir/";

        // Vérifier si le répertoire existe, sinon le créer
        if (!is_dir($uploadDir)) {
            if (!mkdir($uploadDir, 0777, true)) {
                $_SESSION['error_message'] = "Impossible de créer le répertoire de téléchargement.";
                return false;
            }
        }

        // Vérifier si le fichier existe déjà
        $uploadFile = $uploadDir . basename($file['name']);
        if (file_exists($uploadFile)) {
            $_SESSION['error_message'] = "Un fichier avec le même nom existe déjà dans le dossier $subDir.";
            return false;
        }

        // Déplacer le fichier
        if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
            // Insérer le nom et l'extension du fichier dans la base de données
            $fileName = pathinfo($file['name'], PATHINFO_FILENAME); // Nom du fichier sans extension
            $fileExtension = $extension; // Extension du fichier

            $post = new Course($this->getDB());
            if ($post->insertCourse($_SESSION['idEncadrant'], $_SESSION['idClasse'], $fileName, $fileExtension)) {
                $_SESSION['success_message'] = "Cours publié.";
                return true;
            } else {
                $_SESSION['error_message'] = "Erreur lors de la publication.";
            }
        } else {
            $_SESSION['error_message'] = "Échec de la publication du fichier.";
            return false;
        }
    }

    public function insertData() {
        $this->isAdmin();

       // Validation des entrées
       $data = [
        'idEnc' => $_SESSION['idEncadrant'],
        'idCla' => $_SESSION['idClasse'],
        'stagiaire_email' => $_POST['stagiaire_email'] ?? null
        ];

        if (empty($data['stagiaire_email'])) {
            $_SESSION['error_message'] = "Tous les champs obligatoires doivent être remplis.";
            return false;
        }

        // Insérer les données dans la base
        $classModel = new Student($this->getDB());
        if ($classModel->insertStudent($data)) {
            $_SESSION['success_message'] = "Classe insérée avec succès.";
            return true;
        } else {
            $_SESSION['error_message'] = "Erreur lors de l'insertion de la classe.";
            return false;
        }
    }
}
