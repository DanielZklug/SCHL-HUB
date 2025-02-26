<?php

namespace App\Models;

use PDO;
use App\Exceptions\NotFoundException;
use Database\DBConnexion;

abstract class Model{
    protected $db;
    protected $table;

    public function __construct(DBConnexion $db){
        $this->db = $db;
    }

    public function all(){
        // Exécute une requête SQL pour récupérer tous les utilisateurs et leurs profils, triés par ID d'utilisateur décroissant
        $stmt = $this->db->getPDO()->query("
            SELECT 
                utilisateurs.id AS utilisateur_id,
                utilisateurs.nom,
                utilisateurs.prenom,
                profil_utilisateurs.photo,
                profil_utilisateurs.profession
            FROM 
                {$this->table}
            JOIN 
                profil_utilisateurs ON utilisateurs.id = profil_utilisateurs.id_utilisateur
            ORDER BY 
                utilisateurs.id DESC
        ");
        $stmt->setFetchMode(PDO::FETCH_CLASS,get_class($this),[$this->db]);
        // Récupère tous les résultats de la requête
        return $stmt->fetchAll();
    }


    public function findById(int $id): ?Model
    {
        // Prépare une requête SQL pour récupérer un profil d'utilisateur spécifique par son ID
        $stmt = $this->db->getPDO()->prepare("
            SELECT 
                utilisateurs.id AS utilisateur_id,
                utilisateurs.nom,
                utilisateurs.prenom,
                profil_utilisateurs.photo,
                profil_utilisateurs.profession,
                profil_utilisateurs.description
            FROM 
                {$this->table}
            JOIN 
                profil_utilisateurs ON utilisateurs.id = profil_utilisateurs.id_utilisateur
            WHERE utilisateurs.id = ?
        ");
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
        $stmt->execute([$id]); // Exécute la requête avec l'ID fourni
        $result = $stmt->fetch();

        // Si aucun résultat n'est trouvé, lance une exception
        if (!$result) {
            throw new NotFoundException("Aucun enregistrement trouvé avec l'ID : $id");
        }

        return $result;
    }
}