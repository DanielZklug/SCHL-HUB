<?php

namespace Database;

use PDO;

class DBConnexion {
    // Propriétés privées pour stocker les informations de connexion à la base de données
    private $dbname;
    private $host;
    private $username;
    private $password;
    private $pdo;

    // Constructeur de la classe
    public function __construct(string $dbname, string $host, string $username, string $password) {
        // Initialisation des propriétés avec les valeurs fournies
        $this->dbname = $dbname;
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
    }

    // Méthode pour obtenir une instance PDO
    public function getPDO(): PDO {
        // Utilisation de l'opérateur de coalescence nulle (??) pour créer une nouvelle instance PDO si elle n'existe pas déjà
        return $this->pdo ?? $this->pdo = new PDO(
            "mysql:dbname={$this->dbname};host={$this->host}",
            $this->username,
            $this->password,
            [
                // Configuration des options PDO
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Active le mode d'erreur par exception
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, // Définit le mode de récupération par défaut comme objet
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8" // Définit l'encodage de caractères en UTF-8
            ]
        );
    }
}