<?php
namespace App\Models;

class Student extends Model{
    protected $table = 'stagiaire';

    public function delete($id): bool {
        $sql = "UPDATE {$this->table} SET Enc_idEncadrant = NULL, Cla_idClasse = NULL, date_inscription = NULL  WHERE idStagiaire = ?";
        $stmt = $this->db->getPDO()->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function getIdStagiaireByUserId(int $userId): ?int {
        try {
            // Préparer la requête pour récupérer l'idStagiaire
            $stmt = $this->db->getPDO()->prepare("
                SELECT idStagiaire 
                FROM {$this->table} 
                WHERE Uti_idUtilisateur = ?
            ");
            $stmt->execute([$userId]);

            // Récupérer le résultat
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);

            return $result ? (int) $result['idStagiaire'] : null;
        } catch (\Exception $e) {
            // Journaliser l'erreur pour le débogage
            error_log("Erreur lors de la récupération de l'idStagiaire : " . $e->getMessage());
            return null;
        }
    }

    public function getCoursesByStudentAndClass(int $userId, int $classId): array {
        try {
            // Préparer la requête pour récupérer les cours
            $stmt = $this->db->getPDO()->prepare("
                SELECT 
                    c.idCours, 
                    c.nom AS nomCours, 
                    c.extension, 
                    DATE_FORMAT(c.datePub, '%m/%Y à %Hh%imin') AS date,CASE DAYNAME(c.datePub)
                    WHEN 'Sunday' THEN 'Dimanche'
                    WHEN 'Monday' THEN 'Lundi'
                    WHEN 'Tuesday' THEN 'Mardi'
                    WHEN 'Wednesday' THEN 'Mercredi'
                    WHEN 'Thursday' THEN 'Jeudi'
                    WHEN 'Friday' THEN 'Vendredi'
                    WHEN 'Saturday' THEN 'Samedi'
                END AS jour
                FROM cours c
                JOIN stagiaire s 
                  ON c.Cla_idClasse = s.Cla_idClasse 
                 AND c.Enc_idEncadrant = s.Enc_idEncadrant 
                WHERE s.Uti_idUtilisateur = ? AND s.Cla_idClasse = ?
            ");
            
            // Exécuter la requête avec les paramètres
            $stmt->execute([$userId, $classId]);

            // Retourner les résultats sous forme de tableau associatif
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            // Journaliser l'erreur pour le débogage
            error_log("Erreur lors de la récupération des cours : " . $e->getMessage());
            return [];
        }
    }
}