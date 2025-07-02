<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= SCRIPTS.'img'.DIRECTORY_SEPARATOR.'apple-touch-icon.png'?>" rel="shortcut icon" type="image/x-icon"/>
    <title>Erreur 404 - Page non trouvée</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #111827;
            color: #333;
            text-align: center;
        }
        h1 {
            font-size: 18rem;
            margin: 0;
            color: white;
        }
        p {
            font-size: 1.5rem;
            color: white;
            margin: 1rem 0;
        }
        .button {
            padding: 10px 20px;
            font-size: 1.2rem;
            color: white;
            background-color: #007BFF;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: rgb(20, 107, 207);
        }
        @media (max-width: 600px) {
            h1 {
                font-size: 3rem;
            }
            p {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div>
        <h1>404</h1>
        <p><?=$_GET['message']?></p>
        <br>
        <br>
        <br>
        <a href="/schl-hub/accueil" class="button">Retour à la page d'accueil</a>
    </div>
</body>
</html>