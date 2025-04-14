<?php
namespace App\Models;

class Post extends Model{
    protected $table = 'encadrant';

    public function getIdEncadrantByUserId(int $userId): ?int {
        try {
            // Préparer la requête pour récupérer l'idEncadrant
            $stmt = $this->db->getPDO()->prepare("
                SELECT idEncadrant 
                FROM {$this->table} 
                WHERE Uti_idUtilisateur = ?
            ");
            $stmt->execute([$userId]);

            // Récupérer le résultat
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);

            return $result ? (int) $result['idEncadrant'] : null;
        } catch (\Exception $e) {
            // Journaliser l'erreur pour le débogage
            error_log("Erreur lors de la récupération de l'idEncadrant : " . $e->getMessage());
            return null;
        }
    }
}