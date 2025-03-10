<?php

namespace Router;

use App\Exceptions\NotFoundException;

class Router {
    // Propriété pour stocker l'URL actuelle
    public $url;
    // Tableau pour stocker les routes définies
    public $routes = [];

    // Constructeur qui initialise l'URL en retirant les slash au début et à la fin
    public function __construct(string $url) {
        $this->url = trim($url, '/');
    }
    
    // Méthode pour ajouter une route de type GET
    public function get(string $path, string $action) {
        // Ajoute une nouvelle instance de Route au tableau des routes GET
        $this->routes['GET'][] = new Route($path, $action);
    }
    
    public function post(string $path, string $action) {
        // Ajoute une nouvelle instance de Route au tableau des routes GET
        $this->routes['POST'][] = new Route($path, $action);
    }
    
    // Méthode pour exécuter la route correspondante
    public function run() {
        // Parcourt les routes définies pour la méthode de requête actuelle
        foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            // Vérifie si la route correspond à l'URL actuelle
            if($route->matches($this->url)) {
                // Exécute l'action associée à la route
                return $route->execute();
            }
        }

        // Si aucune route ne correspond, renvoie une erreur 404
        throw new NotFoundException("La page n'éxiste pas");
    }
}
