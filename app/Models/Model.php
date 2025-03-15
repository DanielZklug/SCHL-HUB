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
               *
            FROM 
                {$this->table}
            ORDER BY 
               id DESC
        ");
        $stmt->setFetchMode(PDO::FETCH_CLASS,get_class($this),[$this->db]);
        // Récupère tous les résultats de la requête
        return $stmt->fetchAll();
    }

    public function 
    allStudent(): array{
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
                *
            FROM 
                {$this->table}
            WHERE id = ?
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