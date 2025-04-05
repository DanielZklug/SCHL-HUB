<?php

namespace App\Models;

use PDO;
use App\Models\Model;
use App\Exceptions\NotFoundException;

class Message extends Model {
    protected $table = 'message'; // Nom de la table dans la base de données

    /**
     * Enregistre un message dans la base de données.
     *
     * @param array $data
     * @return bool
     */
    public function saveMessage(array $data): bool {
        $sql = "INSERT INTO {$this->table} (idUemetteur, NomUrecepteur, objet, contenu, date_envoi) VALUES (?, ?, ?, ?, NOW())";
        $stmt = $this->db->getPDO()->prepare($sql);
        return $stmt->execute([$data['idEnc'],$data['recever'],$data['title'], $data['content']]);
    }

    public function allMessage(int $id, string $limit = null ): array{
        // Exécute une requête SQL pour récupérer tous les utilisateurs et leurs profils, triés par ID d'utilisateur décroissant
        $stmt = $this->db->getPDO()->prepare("
            SELECT
                idMessage,
                NomUrecepteur,
                objet,
                contenu,
                date_envoi 
            FROM
                {$this->table} m
            WHERE idUemetteur = ?
            ORDER BY idMessage DESC
            $limit
        ");
        // Exécute la requête avec l'ID de l'encadrant
        $stmt->execute([$id]);
    
        // Récupère tous les résultats sous forme de tableau associatif
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function seeMessage(int $id): array{
        // Exécute une requête SQL pour récupérer tous les utilisateurs et leurs profils, triés par ID d'utilisateur décroissant
        $stmt = $this->db->getPDO()->prepare("
            SELECT
                idMessage,
                NomUrecepteur,
                objet,
                contenu,
                date_envoi
            FROM
                {$this->table} m
            WHERE idMessage = ?
        ");
        // Exécute la requête avec l'ID de l'encadrant
        $stmt->execute([$id]);
    
        // Récupère tous les résultats sous forme de tableau associatif
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function delete(int $id){
        return $this->query("DELETE FROM {$this->table} WHERE idMessage = ?", $id);
    }
}