<?php
namespace App\Models;

class Student extends Model{
    protected $table = 'stagiaire';

    public function delete($id): bool {
        $sql = "UPDATE {$this->table} SET Enc_idEncadrant = NULL, Cla_idClasse = NULL, date_inscription = NULL  WHERE idStagiaire = ?";
        $stmt = $this->db->getPDO()->prepare($sql);
        return $stmt->execute([$id]);
    }
}