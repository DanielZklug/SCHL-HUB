<?php
namespace App\Models;

session_start();

class User extends Model {
    public function create(array $data): bool {
        $role = $data['role']; // Le rôle est soit 'encadrant' ou 'stagiaire'
    
        // Commence une transaction
        $this->db->getPDO()->beginTransaction();
    
        try {
            // Vérification de l'existence de l'utilisateur par email
            $checkSql = "SELECT COUNT(*) FROM utilisateurs WHERE email = ?";
            $checkStmt = $this->db->getPDO()->prepare($checkSql);
            $checkStmt->execute([$data['email']]);
            $exists = $checkStmt->fetchColumn();
            
            if ($exists) {
                throw new \Exception("L'utilisateur existe déjà avec cet email");
            }
        
            // Insertion dans la table Utilisateur (commune à tous les utilisateurs)
            $sql = "INSERT INTO utilisateur (`nom`, `prenom`, `motPasse`, `numero`, `email`, `role`) 
                    VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->db->getPDO()->prepare($sql);
            $stmt->execute(array_values($data));

            // Récupère l'ID de l'utilisateur inséré
            $userId = $this->db->getPDO()->lastInsertId();

            // En fonction du rôle, insérer dans la table spécifique (Encadrant ou Stagiaire)
            if ($role === 'encadrant') {
                // Insertion dans la table Encadrant
                $sqlEncadrant = "INSERT INTO encadrant (`Uti_idUtilisateur`) VALUES (?)";
                $stmtEncadrant = $this->db->getPDO()->prepare($sqlEncadrant);
                $stmtEncadrant->execute([$userId]);

                // Récupère l'ID de l'utilisateur inséré
                $userIdEncadrant = $this->db->getPDO()->lastInsertId();

                // Insertion dans la table Encadrant
                $sqlEncadrantP = "INSERT INTO profisocial (`Enc_idEncadrant`) VALUES (?)";
                $stmtEncadrant = $this->db->getPDO()->prepare($sqlEncadrantP);
                $stmtEncadrant->execute([$userIdEncadrant]);


            } elseif ($role === 'etudiant') {
                // Insertion dans la table Stagiaire
                $sqlStagiaire = "INSERT INTO stagiaire (`Uti_idUtilisateur`) VALUES (?)";
                $stmtStagiaire = $this->db->getPDO()->prepare($sqlStagiaire);
                $stmtStagiaire->execute([$userId]);
            } else {
                throw new \Exception("Rôle non reconnu");
            }
        
            // Valide la transaction
            $this->db->getPDO()->commit();
            return true;

        } catch (\Exception $e) {
            // En cas d'erreur, annule la transaction et redirige l'utilisateur
            $this->db->getPDO()->rollBack();
            // Optionnel : Ajouter un message d'erreur plus précis si nécessaire
            $_SESSION['error_message'] = $e->getMessage();
            return false;
        }
    }
}
