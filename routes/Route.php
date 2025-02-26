<?php

namespace Router;

use Database\DBConnexion;

class Route {
    public $path;
    public $action;
    public $matches;

    public function __construct($path, $action) {
        $this->path = trim($path, '/');
        $this->action = $action;
    }

    public function matches(string $url) {
        // Remplace les paramètres dynamiques dans le chemin par des expressions régulières
        $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->path);
        $pathToMatch = "#$path$#";

        // Vérifie si l'URL correspond au chemin de la route
        if (preg_match($pathToMatch, $url, $matches)) {
            $this->matches = $matches;
            return true;
        } else {
            return false;
        }
    }

    public function execute() {
        // Sépare le nom du contrôleur et la méthode
        $params = explode("@", $this->action);
        
        // Crée une nouvelle instance du contrôleur avec une connexion à la base de données
        $controller = new $params[0]((new DBConnexion(DB_NAME, DB_HOST, DB_USERNAME, DB_PASSWORD)));
        $method = $params[1];

        // Exécute la méthode du contrôleur avec ou sans paramètre
        if (isset($this->matches[1])) {
            $controller->$method($this->matches[1]);
        } else {
            $controller->$method();
        }
    }
}