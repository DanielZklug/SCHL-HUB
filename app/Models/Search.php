<?php
namespace App\Models;

use PDO;
use App\Models\Model;

class Search extends Model {

    public function performSearch(string $query, int $encadrantId): array {
        if (empty($query)) {
            $_SESSION['error_message'] = 'Le paramètre de recherche est vide.';
            return [];
        }
    
        if ($encadrantId <= 0) {
            $_SESSION['error_message'] = 'L\'identifiant de l\'encadrant est invalide.';
            return [];
        }
    
        $sql = "
       SELECT 
        cl.idClasse, 
        cl.nom AS class_name, 
        DATE_FORMAT(cl.dateCreation, '%d/%m/%Y à %Hh%imin%ss') AS class_creation_date,
        u.idUtilisateur,
        CONCAT(u.nom, ' ', u.prenom) AS stagiaire_name,
        u.email,
        DATE_FORMAT(st.date_inscription, '%d/%m/%Y à %Hh%imin%ss') AS date_inscription
        FROM 
            classe cl
        JOIN 
            stagiaire st ON cl.idClasse = st.Cla_idClasse
        JOIN 
            utilisateur u ON st.Uti_idUtilisateur = u.idUtilisateur
        WHERE 
            cl.Enc_idEncadrant = :encadrantId
        AND (
            cl.nom LIKE :query OR
            u.email LIKE :query OR
            CONCAT(u.nom, ' ', u.prenom) LIKE :query
        )";
        $stmt = $this->db->getPDO()->prepare($sql);
    
        try {
            // Utilisation de bindValue pour plus de clarté et contrôle
            $stmt->bindValue(':query', "%$query%", PDO::PARAM_STR);
            $stmt->bindValue(':encadrantId', $encadrantId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            $_SESSION['error_message'] = 'Une erreur est survenue lors de l\'exécution de la requête : ' . $e->getMessage();
            // Log l'erreur pour débogage
            error_log($e->getMessage());
            return [];
        }
    }
}
