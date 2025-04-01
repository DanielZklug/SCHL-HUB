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
                    'idStag' => $_SESSION['idStaUser'],
                    'content' => $content
                ]);
    
                // Configuration du serveur SMTP
                $mail->SMTPDebug = SMTP::DEBUG_OFF; // Désactiver le débogage SMTP
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'danielzklug@gmail.com';
                $mail->Password   = 'lsnkbshsjqicyygh';
                $mail->SMTPSecure = 'ssl';
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
                            body { font-family: Arial, sans-serif; line-height: 1.6; }
                            .header { background-color: #f4f4f4; padding: 10px; text-align: center; }
                            .content { margin: 20px; padding: 20px; border: 1px solid #ddd; border-radius: 5px; }
                            .footer { margin-top: 20px; text-align: center; font-size: 12px; color: #888; }
                        </style>
                    </head>
                    <body>
                        <div class='header'>
                            <h2>Message de SCHL-HUB</h2>
                        </div>
                        <div class='content'>
                            <p>Bonjour <strong>{$receverName}</strong>,</p>
                            <p>{$content}</p>
                            <p>Cordialement,<br>L'équipe SCHL-HUB</p>
                        </div>
                        <div class='footer'>
                            <p>Ce message a été envoyé depuis la plateforme SCHL-HUB.</p>
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

        // $post = new Student($this->getDB());
        // $result = $post->delete($id);

        // if($result){
        //     return header("Location: /schl-hub/admin/student");
        // }
    }
}