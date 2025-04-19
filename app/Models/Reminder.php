<?php

namespace App\Models;

class Reminder extends Model {
    protected $table = 'rappels';

    public function createReminder(array $data): bool {
        try {
            // Préparer la requête pour insérer un rappel
            $stmt = $this->db->getPDO()->prepare("
                INSERT INTO {$this->table} (titre, description, date_heure, utilisateur_id) 
                VALUES (:title, :description, :reminder_date, :user_id)
            ");
            
            // Exécuter la requête avec les données fournies
            return $stmt->execute([
                ':title' => $data['reminder_title'],
                ':description' => $data['reminder_description'],
                ':reminder_date' => $data['reminder_date'],
                ':user_id' => $data['user_id']
            ]);
        } catch (\Exception $e) {
            // Journaliser l'erreur pour le débogage
            error_log("Erreur lors de la création du rappel : " . $e->getMessage());
            return false;
        }
    }

    public function getRemindersByUserId(int $userId): array {
        try {
            // Préparer la requête pour récupérer les rappels par utilisateur_id
            $stmt = $this->db->getPDO()->prepare("
                SELECT * 
                FROM {$this->table} 
                WHERE utilisateur_id = :user_id
            ");
            
            // Exécuter la requête avec l'identifiant de l'utilisateur
            $stmt->execute([':user_id' => $userId]);

            // Retourner les résultats sous forme de tableau associatif
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            // Journaliser l'erreur pour le débogage
            error_log("Erreur lors de la récupération des rappels : " . $e->getMessage());
            return [];
        }
    }

    public function getRemindersById(int $id): array {
        try {
            // Préparer la requête pour récupérer les rappels par utilisateur_id
            $stmt = $this->db->getPDO()->prepare("
                SELECT id,titre,description,DATE_FORMAT(date_heure, '%m/%Y à %Hh%imin%ss') AS date,CASE DAYNAME(date_heure)
                WHEN 'Sunday' THEN 'Dimanche'
                WHEN 'Monday' THEN 'Lundi'
                WHEN 'Tuesday' THEN 'Mardi'
                WHEN 'Wednesday' THEN 'Mercredi'
                WHEN 'Thursday' THEN 'Jeudi'
                WHEN 'Friday' THEN 'Vendredi'
                WHEN 'Saturday' THEN 'Samedi'
            END AS jour
                FROM {$this->table} 
                WHERE id = :id
            ");
            
            // Exécuter la requête avec l'identifiant de l'utilisateur
            $stmt->execute([':id' => $id]);

            // Retourner les résultats sous forme de tableau associatif
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            // Journaliser l'erreur pour le débogage
            error_log("Erreur lors de la récupération des rappels : " . $e->getMessage());
            return [];
        }
    }

    public function delete(int $id){
        return $this->query("DELETE FROM {$this->table} WHERE id = ?", $id);
    }
}
