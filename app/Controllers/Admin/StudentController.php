<?php

namespace App\Controllers\Admin;

use App\Models\Post;
use App\Models\Message;
use App\Models\Student;
use PHPMailer\PHPMailer\SMTP;

use App\Controllers\Controller;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use App\Exceptions\NotFoundException;

class StudentController extends Controller{
    
    public function index(){
        $this->isAdmin();

        if (!is_numeric($_SESSION['idEncUser']) || floor($_SESSION['idEncUser']) != $_SESSION['idEncUser']) {
            throw new NotFoundException("L'identifiant du post doit être un entier.");
        }

        $_SESSION['idEncUser'] = (int)$_SESSION['idEncUser']; // Conversion explicite en entier
        $post = new Post($this->getDB());
        $post = $post->findProfil($_SESSION['idEncUser']);

        if (!$post) {
            throw new NotFoundException("Aucun post trouvé avec l'identifiant : {$_SESSION['idEncUser']}");
        }

        // Appelle la fonction pour récupérer les stagiaires
        $stagiaires = (new Student($this->getDB()))->getStagiairesByEncadrant($_SESSION['idEncUser']);

        return $this->viewAdmin('admin.student.index', compact('post', 'stagiaires'));
    }


    public function show($id) {
        $this->isAdmin();
    
        if (!is_numeric($id) || floor($id) != $id) {
            throw new NotFoundException("L'identifiant du post doit être un entier.");
        }

        $id = (int)$id; // Conversion explicite en entier
        $post = new Student($this->getDB());
        $posts = $post->findByIdStagiaire($id);

        if (!$post) {
            throw new NotFoundException("Aucun post trouvé avec l'identifiant : $id");
        }

        $_SESSION['idEncUser'] = (int)$_SESSION['idEncUser']; // Conversion explicite en entier
        $post = new Post($this->getDB());
        $post = $post->findProfil($_SESSION['idEncUser']);


        return $this->viewAdmin('admin.student.show', compact('posts','post'));
    }

    public function sendMessage() {
        $this->isAdmin();
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Valider les données du formulaire
            $receverEmail = $_POST['recever_email'] ?? null;
            $receverName = $_POST['recever_name'] ?? null;
            $contentTitle = $_POST['content-title'] ?? null;
            $content = $_POST['content'] ?? null;
    
            if (empty($receverEmail) || empty($content)) {
                $_SESSION['error_message'] = "Tous les champs sont obligatoires.";
                header("Location: /schl-hub/admin/message/form");
                exit;
            }
    
            // Assurer que les entrées sont valides
            $receverEmail = filter_var($receverEmail, FILTER_SANITIZE_EMAIL);
            $receverName = htmlspecialchars($receverName, ENT_QUOTES, 'UTF-8');
            $content = htmlspecialchars($content, ENT_QUOTES, 'UTF-8');
    
            // Créer une instance de PHPMailer
            $mail = new PHPMailer(true);
    
            try {
                // Enregistrer le message dans la base de données
                $messageModel = new Message($this->getDB());
                $result = $messageModel->saveMessage([
                    'idEnc' => $_SESSION['idEncUser'],
                    'recever' => $receverName,
                    'title' => $contentTitle,
                    'content' => $content
                ]);
    
                // Configuration du serveur SMTP
                $mail->SMTPDebug = SMTP::DEBUG_OFF; // Désactiver le débogage SMTP
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'danielzklug@gmail.com';
                $mail->Password   = 'lsnkbshsjqicyygh';
                $mail->SMTPSecure =  PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port       = 465;
    
                // Destinataires
                $mail->setFrom('danielzklug@gmail.com', 'Admin SCHL-HUB');
                $mail->addAddress($receverEmail, $receverName);
    
                // Contenu de l'email
                $mail->isHTML(true); 
                $mail->Subject = 'Nouveau message de SCHL-HUB';
    
                // Contenu HTML du message
                $mail->Body = "
                    <html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                line-height: 1.6;
                margin: 0;
                padding: 0;
                background-color: #f7f7f7;
            }
            .header {
                background-color: #ffffff;
                padding: 20px;
                text-align: center;
            }
            .logo {
                width: 80px;
                height: 80px;
                border-radius: 50%;
                overflow: hidden;
                margin-bottom: 20px;
            }
            .logo img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
            .content {
                background-color: #ffffff;
                margin: 20px;
                padding: 30px;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                border: 1px solid #ddd;
            }
            .footer {
                margin-top: 20px;
                text-align: center;
                font-size: 12px;
                color: #888;
                padding: 15px;
            }
            h2 {
                margin-bottom: 20px;
                font-size: 24px;
            }
            p {
                font-size: 16px;
                line-height: 1.6;
            }
        </style>
    </head>
    <body>
        <div class='header'>
            <!-- Zone circulaire pour le logo -->
            <div class='logo'>
                <img src='https://drive.google.com/file/d/1mv5jq-jhdZxKE9KLn_Dz_Jxb6lCSD8DU/view?usp=drive_link' alt='Logo SCHL-HUB' />
            </div>
        </div>
        <div class='content'>
            <p>Bonjour <strong>{$receverName}</strong>,</p>
            <p>{$content}</p>
        </div>
        <div class='footer'>
            <p>Ce message a été envoyé depuis la plateforme <strong>SCHL-HUB</strong>.</p>
        </div>
    </body>
</html>

                ";
    
                // Contenu texte brut
                $mail->AltBody = "Bonjour {$receverName},\n\n{$content}\n\nCordialement,\nL'équipe SCHL-HUB";
    
                // Envoyer l'email
                $mail->send();
                $_SESSION['success_message'] = "Message envoyé avec succès.";
                header("Location: /schl-hub/admin/student");
                exit;
            } catch (Exception $e) {
                $_SESSION['error_message'] = "Le message n'a pas pu être envoyé. Erreur : {$mail->ErrorInfo}";
                header("Location: /schl-hub/admin/student");
                exit;
            }
        }
    
        // Rediriger si la méthode n'est pas POST
        header("Location: /schl-hub/admin/student");
        exit;
    }
    

    public function delete(int $id){
        $this->isAdmin();

        $post = new Student($this->getDB());
        $result = $post->delete($id);

        if($result){
            return header("Location: /schl-hub/admin/student");
        }
    }
}