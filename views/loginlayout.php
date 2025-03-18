<?php
session_start();

// Fonction pour afficher un message
function afficherMessage($type, $message) {
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            const alertContainer = document.createElement('div');
            alertContainer.className = 'message-$type';
            alertContainer.textContent = '$message';
            document.body.appendChild(alertContainer);
            setTimeout(() => {
                alertContainer.remove();
            }, 3000); // Masquer après 3 secondes
        });
    </script>";
}

// Exemple d'utilisation
if (isset($_SESSION['success_message'])) {
    afficherMessage('succes', $_SESSION['success_message']);
    unset($_SESSION['success_message']);
}

if (isset($_SESSION['error_message'])) {
    afficherMessage('erreur', $_SESSION['error_message']);
    unset($_SESSION['error_message']);
}
?>
<!DOCTYPE html>
<!-- This site was created in Webflow. http://www.webflow.com -->
<!-- Last Published: Mon Jun 14 2021 20:30:44 GMT+0000 (Coordinated Universal Time) -->
<html data-wf-domain="dawn-dashboard.webflow.io" data-wf-page="6022ffeab6f354d1da1eb2ae" data-wf-site="6022ffeab6f354c9aa1eb2a2">
    <head>
        <meta charset="utf-8"/>
        <title>SCHLhub - <?=$title?></title>
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta content="Webflow" name="generator"/>
        <link rel="stylesheet" href="<?= SCRIPTS.'css'.DIRECTORY_SEPARATOR.'adminstyle.css'?>" type="text/css"/>
        <script type="text/javascript">
            !function(o, c) {
                var n = c.documentElement
                  , t = " w-mod-";
                n.className += t + "js",
                ("ontouchstart"in o || o.DocumentTouch && c instanceof DocumentTouch) && (n.className += t + "touch")
            }(window, document);
        </script>
        <link href="<?= SCRIPTS.'img'.DIRECTORY_SEPARATOR.'apple-touch-icon.png'?>" rel="shortcut icon" type="image/x-icon"/>
        <style>
            /* Style pour un message d'erreur */
            .message-erreur {
                background-color: #f8d7da; /* Rouge clair */
                color: #721c24; /* Rouge foncé */
                border: 1px solid #f5c6cb; /* Bordure rouge */
                padding: 10px;
                margin: 15px 0;
                border-radius: 5px;
                position: fixed;
                top: 20px; /* Positionner en haut */
                right: 20px; /* Positionner à droite */
                z-index: 1000; /* S'assurer qu'il est au-dessus des autres éléments */
            }

            /* Style pour un message de succès */
            .message-succes {
                background-color: #d4edda; /* Vert clair */
                color: #155724; /* Vert foncé */
                border: 1px solid #c3e6cb; /* Bordure verte */
                padding: 10px;
                margin: 15px 0;
                border-radius: 5px;
                position: fixed;
                top: 20px; /* Positionner en haut */
                right: 20px; /* Positionner à droite */
                z-index: 1000; /* S'assurer qu'il est au-dessus des autres éléments */
            }
        </style>
        <!-- <script type="text/javascript">
            WebFont.load({
                google: {
                    families: ["Lato:100,100italic,300,300italic,400,400italic,700,700italic,900,900italic"]
                }
            });
        </script> -->
        <!-- <script type="text/javascript">
            !function(o, c) {
                var n = c.documentElement
                  , t = " w-mod-";
                n.className += t + "js",
                ("ontouchstart"in o || o.DocumentTouch && c instanceof DocumentTouch) && (n.className += t + "touch")
            }(window, document); -->
        <!-- </script> -->
    </head>
    <body class="center-card-container">
        <?= $content; ?>
    </body>
    <!-- <script src="assets/js/jquery.js" type="text/javascript"></script>
    <script src="assets/js/script.js" type="text/javascript"></script> -->
    <!--[if lte IE 9]><script src="//cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif]-->
</html>