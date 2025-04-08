<?php
namespace App\Models;

class Course extends Model{
    protected $table = 'cours';

    public function insertCourse(int $idEnc, int $idCla, string $fileName, string $fileExtension) {
        try {
            // Préparation de la requête avec un paramètre lié pour éviter l'injection SQL
            $stmt = $this->db->getPDO()->prepare(" INSERT INTO {$this->table} (Enc_idEncadrant, Cla_idClasse, nom, extension, datePub) VALUES (?, ?, ?, ?, NOW()) ");
            
            // Lier les paramètres et exécuter la requête
            $stmt->execute([$idEnc, $idCla, $fileName, $fileExtension]);
            
            return true; // Insertion réussie
        } catch (\Exception $e) {
            $_SESSION['error_message'] = "Erreur lors de l'insertion du fichier : " . $e->getMessage();
            
            // Journaliser l'erreur pour le débogage
            error_log("Insertion de fichier échouée : " . $e->getMessage());
            
            return false; // Échec de l'insertion
        }
    }

    public function getCoursesByExtension(string $extension = null, int $idEncadrant): array {
        try {
            // Construire la requête de base avec une jointure pour récupérer le nom de la classe
            $query = "
                SELECT c.nom, c.idCours ,DATE_FORMAT(c.datePub, '%d/%m/%Y à %Hh%imin%ss') AS datePub, cl.nom AS class_name
                FROM {$this->table} c
                JOIN classe cl ON c.Cla_idClasse = cl.idClasse
                WHERE c.Enc_idEncadrant = ?
            ";
    
            // Ajouter la condition pour l'extension si elle est spécifiée
            $params = [$idEncadrant];
    
            if ($extension) {
                $query .= " AND c.extension = ?";
                $params[] = $extension;
            }
    
            // Préparer et exécuter la requête
            $stmt = $this->db->getPDO()->prepare($query);
            $stmt->execute($params);
    
            // Retourner les résultats sous forme de tableau associatif
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            // Journaliser l'erreur pour le débogage
            error_log("Erreur lors de la récupération des cours : " . $e->getMessage());
            return [];
        }
    }
    
    public function delete($id): bool {
        try {
            // Préparer la requête pour supprimer un cours spécifique
            $sql = "DELETE FROM {$this->table} WHERE idCours = ?";
            $stmt = $this->db->getPDO()->prepare($sql);
            
            // Exécuter la requête avec l'identifiant du cours
            return $stmt->execute([$id]);
        } catch (\Exception $e) {
            // Journaliser l'erreur pour le débogage
            error_log("Erreur lors de la suppression du cours : " . $e->getMessage());
            return false;
        }
    }
    
}