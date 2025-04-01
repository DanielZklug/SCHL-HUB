<?php

namespace App\Models;

use App\Models\Model;

class Message extends Model {
    protected $table = 'message'; // Nom de la table dans la base de données

    /**
     * Enregistre un message dans la base de données.
     *
     * @param array $data
     * @return bool
     */
    public function saveMessage(array $data): bool {
        $sql = "INSERT INTO {$this->table} (idUemetteur, idUrecepteur, contenu, date_envoi) VALUES (?, ?, ?, NOW())";
        $stmt = $this->db->getPDO()->prepare($sql);
        return $stmt->execute([$data['idEnc'],$data['idStag'], $data['content']]);
    }
}