<?php
namespace App\Models;
class User extends Model {
    protected $table = 'utilisateur';
    public function create(array $data): bool {
        $role = $data['role']; // Le rôle est soit 'encadrant' ou 'stagiaire'
    
        // Commence une transaction
        $this->db->getPDO()->beginTransaction();
    
        try {
            // Vérification de l'existence de l'utilisateur par email
            $checkSql = "SELECT COUNT(*) FROM utilisateur WHERE email = ?";
            $checkStmt = $this->db->getPDO()->prepare($checkSql);
            $checkStmt->execute([$data['email']]);
            $exists = $checkStmt->fetchColumn();
            
            if ($exists) {
                throw new \Exception("Un utilisateur existe déjà avec cet email");
            }
        
            // Insertion dans la table Utilisateur (commune à tous les utilisateurs)
            $sql = "INSERT INTO utilisateur (`nom`, `prenom`, `motPasse`, `numero`, `email`, `role`) VALUES (?, ?, ?, ?, ?, ?)";
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

                // Récupère l'ID de l'encadrant inséré
                $userIdEncadrant = $this->db->getPDO()->lastInsertId();

                // Insertion dans la table profisocial
                $sqlEncadrantP = "INSERT INTO profilsocial (`Enc_idEncadrant`) VALUES (?)";
                $stmtEncadrantP = $this->db->getPDO()->prepare($sqlEncadrantP);
                $stmtEncadrantP->execute([$userIdEncadrant]);

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
            // En cas d'erreur, annule la transaction
            $this->db->getPDO()->rollBack();
            // Enregistre le message d'erreur dans la session
            $_SESSION['error_message'] = $e->getMessage();
            return false;
        }
    }

    public function getByUsername(string $email){
        return $this->query("SELECT * FROM {$this->table} WHERE email = ?",$email, true);
    }
}
