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

    public function all(): array{
        // Exécute une requête SQL pour récupérer tous les utilisateurs et leurs profils, triés par ID d'utilisateur décroissant
        $stmt = $this->db->getPDO()->query("
            SELECT
                e.idEncadrant, 
                u.nom AS nom_utilisateur, 
                u.prenom AS prenom_utilisateur,  
                u.photo AS photo_utilisateur, 
                e.profession AS profession_encadrant
            FROM
                {$this->table} e
            JOIN utilisateur u ON e.Uti_idUtilisateur = u.idUtilisateur
            ORDER BY e.idEncadrant DESC
        ");
        $stmt->setFetchMode(PDO::FETCH_CLASS,get_class($this),[$this->db]);
        // Récupère tous les résultats de la requête
        return $stmt->fetchAll();
    }

    public function allStudent(): array{
        // Exécute une requête SQL pour récupérer tous les utilisateurs et leurs profils, triés par ID d'utilisateur décroissant
        $stmt = $this->db->getPDO()->query("
            SELECT 
            *
            FROM 
                {$this->table}
        ");
        $stmt->setFetchMode(PDO::FETCH_CLASS,get_class($this),[$this->db]);
        // Récupère tous les résultats de la requête
        return $stmt->fetchAll();
    }
    
    public function delete(int $id){
        return $this->query("DELETE FROM {$this->table} WHERE id = ?", $id);
    }

    public function query(string $sql, int $param = null, bool $single = null){
        $method = is_null($param) ? 'query' : 'prepare';

        if(strpos($sql, "DELETE") === 0 || strpos($sql, "UPDATE") === 0 || strpos($sql, "CREATE") === 0){
            $stmt = $this->db->getPDO()->$method($sql);
            $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this),[$this->db]);

            return $stmt->execute([$param]);
        }
        $fetch = is_null($single) ? 'fetchAll' : 'fetch';

        $stmt = $this->db->getPDO()->$method($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this),[$this->db]);

        if($method === 'query'){
            return $stmt->$fetch();
        }else{
            $stmt->execute([$param]);
            return $stmt->$fetch();
        }
    }    

    public function findById(int $id): ?Model
    {
        // Prépare une requête SQL pour récupérer un profil d'utilisateur spécifique par son ID
        $stmt = $this->db->getPDO()->prepare("
            SELECT
                e.idEncadrant, 
                u.nom AS nom_utilisateur, 
                u.prenom AS prenom_utilisateur,  
                u.photo AS photo_utilisateur,
                u.numero AS numero_utilisateur,
                u.email AS email_utilisateur,
                ps.gitlab AS gitlab, 
                ps.github AS github, 
                ps.facebook AS facebook, 
                ps.instagram AS instagram, 
                ps.google AS google,  
                e.emailOrg AS email_organisationnel,
                e.bio AS bio_encadrant,
                e.profession AS profession_encadrant
            FROM
                {$this->table} e
            JOIN utilisateur u ON e.Uti_idUtilisateur = u.idUtilisateur
            JOIN profilsocial ps ON e.idEncadrant = ps.Enc_idEncadrant
            WHERE e.idEncadrant = ?
            ORDER BY e.idEncadrant DESC
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

    public function countByGender(?string $gender = null): int{
        $sql = "SELECT COUNT(*) as count FROM {$this->table}";
        $params = [];

        if ($gender !== null) {
            $sql .= " WHERE genre = ?";
            $params[] = $gender;
        }

        $stmt = $this->db->getPDO()->prepare($sql);
        $stmt->execute($params);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return (int) $result['count'];
    }
}