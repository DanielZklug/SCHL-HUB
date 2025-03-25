<?php
namespace App\Models;

class Classe extends Model{
    protected $table = 'classe';

    public function createClass(array $data): bool {
        // Validation des données
        if (empty($data['nom_classe']) || empty($data['stagiaire_email'])) {
            throw new \Exception("Tous les champs obligatoires doivent être remplis.");
        }
    
        $nom = $data['nom_classe'];
        $stagiaireEmail = $data['stagiaire_email'];
    
        // Commence une transaction
        $this->db->getPDO()->beginTransaction();
    
        try {
            // Vérification de l'existence de la classe
            $checkSql = "SELECT COUNT(*) FROM {$this->table} WHERE nom = ?";
            $checkStmt = $this->db->getPDO()->prepare($checkSql);
            $checkStmt->execute([$nom]);
            $exists = $checkStmt->fetchColumn();
    
            if ($exists) {
                throw new \Exception("Cette classe existe déjà.");
            }
    
            // Recherche de l'utilisateur par email et vérification du rôle "etudiant"
            $userSql = "SELECT idUtilisateur, role FROM utilisateur WHERE email = ?";
            $userStmt = $this->db->getPDO()->prepare($userSql);
            $userStmt->execute([$stagiaireEmail]);
            $user = $userStmt->fetch();
    
            if (!$user) {
                throw new \Exception("Aucun utilisateur trouvé avec l'email : $stagiaireEmail");
            }
    
            // Vérifie que l'utilisateur a bien le rôle "etudiant"
            if ($user->role !== 'etudiant') {
                throw new \Exception("L'utilisateur n'a pas le rôle 'etudiant'.");
            }
    
            // Vérification si l'étudiant est déjà associé à une classe ou un encadrant dans la table stagiaire
            $stagiaireCheckSql = "SELECT COUNT(*) FROM stagiaire WHERE Uti_idUtilisateur = ? AND (Enc_idEncadrant IS NOT NULL OR Cla_idClasse IS NOT NULL)";
            $stagiaireCheckStmt = $this->db->getPDO()->prepare($stagiaireCheckSql);
            $stagiaireCheckStmt->execute([$user->idUtilisateur]);
            $stagiaireExists = $stagiaireCheckStmt->fetchColumn();
    
            if ($stagiaireExists > 0) {
                throw new \Exception("Cet étudiant est déjà associé à une classe ou un encadrant.");
            }
    
            // Insertion dans la table classe
            $sql = "INSERT INTO {$this->table} (`Uti_idUtilisateur`, `Enc_idEncadrant`, `nom`, `dateCreation`) VALUES (?, ?, ?, NOW())";
            $stmt = $this->db->getPDO()->prepare($sql);
            $stmt->execute([
                $data['idEncUser'],  // ID de l'utilisateur trouvé
                $data['idEnc'],           // ID de l'encadrant
                $data['nom_classe']       // Nom de la classe
            ]);
    
            // Récupérer l'ID de la classe insérée (auto-incrementé)
            $idClasse = $this->db->getPDO()->lastInsertId();
    
            // Mettre à jour la table stagiaire avec l'association entre l'étudiant, l'encadrant, et la classe
            $stagiaireUpdateSql = "UPDATE stagiaire SET Enc_idEncadrant = ?, Cla_idClasse = ? WHERE Uti_idUtilisateur = ?";
            $stagiaireUpdateStmt = $this->db->getPDO()->prepare($stagiaireUpdateSql);
            $stagiaireUpdateStmt->execute([
                $data['idEnc'],            // ID de l'encadrant
                $idClasse,                 // ID de la classe
                $user->idUtilisateur     // ID de l'utilisateur
            ]);
    
            // Envoi d'une notification dans la table notification
            $notificationSql = "INSERT INTO notification (`Uti_idUtilisateur`, `titre`, `description`) VALUES (?, ?, ?)";
            $notificationStmt = $this->db->getPDO()->prepare($notificationSql);
            $notificationMessage = "Une nouvelle classe a été créée pour vous.";
            $notificationStmt->execute([
                $user->idUtilisateur,   // ID de l'étudiant
                'Nouvelle classe',        // Titre
                $notificationMessage      // Message de notification
            ]);
    
            // Valide la transaction
            $this->db->getPDO()->commit();
            return true;
    
        } catch (\Exception $e) {
            // En cas d'erreur, annule la transaction
            $this->db->getPDO()->rollBack();
            error_log($e->getMessage()); // Journalise l'erreur
            $_SESSION['error_message'] = $e->getMessage();
            return false;
        }
    }
    
}