<?php
namespace App\Models;

class Classe extends Model {
    protected $table = 'classe';

    public function createClass(array $data): bool {
        // Validation des données
        if (empty($data['nom_classe']) || empty($data['stagiaire_email'])) {
            throw new \Exception("Tous les champs obligatoires doivent être remplis.");
        }
    
        $nom = $data['nom_classe'];
        $stagiaireEmail = $data['stagiaire_email'];
    
        // Validation de l'email
        if (!filter_var($stagiaireEmail, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception("L'email fourni n'est pas valide.");
        }
    
        // Commence une transaction
        $this->db->getPDO()->beginTransaction();
    
        try {
            // Vérification de l'existence de la classe
            if ($this->classExists($nom)) {
                throw new \Exception("Cette classe existe déjà.");
            }
    
            // Recherche de l'utilisateur par email
            $userSql = "SELECT idUtilisateur, role FROM utilisateur WHERE email = ?";
            $userStmt = $this->db->getPDO()->prepare($userSql);
            $userStmt->execute([$stagiaireEmail]);
            $user = $userStmt->fetch(\PDO::FETCH_OBJ);
    
            if (!$user) {
                throw new \Exception("Aucun utilisateur trouvé avec l'email : $stagiaireEmail");
            }
    
            if ($user->role !== 'etudiant') {
                throw new \Exception("L'utilisateur n'a pas le rôle 'etudiant'.");
            }
    
            // Vérification si l'étudiant est déjà associé
            $stagiaireCheckSql = "SELECT COUNT(*) FROM stagiaire WHERE Uti_idUtilisateur = ?";
            $stagiaireCheckStmt = $this->db->getPDO()->prepare($stagiaireCheckSql);
            $stagiaireCheckStmt->execute([$user->idUtilisateur]);
            if ($stagiaireCheckStmt->fetchColumn() > 0) {
                throw new \Exception("Cet étudiant est déjà associé à une classe ou un encadrant.");
            }
    
            // Insertion dans la table classe
            $sql = "INSERT INTO {$this->table} (`Uti_idUtilisateur`, `Enc_idEncadrant`, `nom`, `dateCreation`) VALUES (?, ?, ?, NOW())";
            $stmt = $this->db->getPDO()->prepare($sql);
            $stmt->execute([$data['idEncUser'], $data['idEnc'], $nom]);
    
            // Mise à jour de la table stagiaire
            $idClasse = $this->db->getPDO()->lastInsertId();
            $stagiaireUpdateSql = "UPDATE stagiaire SET Enc_idEncadrant = ?, Cla_idClasse = ? WHERE Uti_idUtilisateur = ?";
            $stagiaireUpdateStmt = $this->db->getPDO()->prepare($stagiaireUpdateSql);
            $stagiaireUpdateStmt->execute([$data['idEnc'], $idClasse, $user->idUtilisateur]);
    
            // Notification
            $notificationSql = "INSERT INTO notification (`Uti_idUtilisateur`, `titre`, `description`) VALUES (?, ?, ?)";
            $notificationStmt = $this->db->getPDO()->prepare($notificationSql);
            $notificationStmt->execute([$user->idUtilisateur, 'Nouvelle classe', "Une nouvelle classe a été créée pour vous."]);
    
            // Valide la transaction
            $this->db->getPDO()->commit();
            return true;
    
        } catch (\Exception $e) {
            // Journalisation de l'erreur avant de rollback
            error_log("Erreur dans la méthode createClass : " . $e->getMessage(), 3, __DIR__ . '/../../logs/errors.log');
            $this->db->getPDO()->rollBack();
            $_SESSION['error_message'] = $e->getMessage();
            return false;
        }
    }
    

    private function classExists(string $nom): bool {
        $checkSql = "SELECT COUNT(*) FROM {$this->table} WHERE nom = ?";
        $checkStmt = $this->db->getPDO()->prepare($checkSql);
        $checkStmt->execute([$nom]);
        return $checkStmt->fetchColumn() > 0;
    }

    public function delete($id) {
        try {
            $this->db->getPDO()->beginTransaction();

            // Vérification des relations
            $relationSql = "SELECT COUNT(*) FROM stagiaire WHERE Cla_idClasse = ?";
            $relationStmt = $this->db->getPDO()->prepare($relationSql);
            $relationStmt->execute([$id]);
            if ($relationStmt->fetchColumn() > 0) {
                throw new \Exception("Impossible de supprimer la classe car elle est associée à des stagiaires.");
            }

            // Suppression
            $sqlClasse = "DELETE FROM {$this->table} WHERE idClasse = ?";
            $stmtClasse = $this->db->getPDO()->prepare($sqlClasse);
            $stmtClasse->execute([$id]);

            $this->db->getPDO()->commit();
            return true;

        } catch (\Exception $e) {
            $this->db->getPDO()->rollBack();
            error_log($e->getMessage());
            $_SESSION['error_message'] = "Erreur lors de la suppression : " . $e->getMessage();
            return false;
        }
    }
}