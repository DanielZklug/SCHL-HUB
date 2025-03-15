<?php
namespace App\Models;

class User extends Model{
    public function create(array $data) {
        $role = $data['role'];
        unset($data['role']); // Retire le rôle des données à insérer
    
        // Commence une transaction
        $this->db->getPDO()->beginTransaction();
    
        try {
            // Vérification de l'existence de l'utilisateur par email
            $checkSql = "SELECT COUNT(*) FROM " . ($role === 'etudiant' ? 'etudiants' : 'encadrants') . " WHERE email = ?";
            $checkStmt = $this->db->getPDO()->prepare($checkSql);
            $checkStmt->execute([$data['email']]);
            $exists = $checkStmt->fetchColumn();
            
            if ($exists) {
                throw new \Exception("L'utilisateur existe déjà avec cet email");
            }
        
            // Insertion dans la table spécifique en fonction du rôle
            if ($role === 'encadrant') {
                $sql = "INSERT INTO encadrants (`nom`, `prenom`, `numero`, `email`, `email_org`, `mot_passe`, `role`) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $data['role'] = $role; // Ajoutez le rôle à la fin des valeurs
                $stmt = $this->db->getPDO()->prepare($sql);
                $stmt->execute(array_values($data));
            } elseif ($role === 'etudiant') {
                $sql = "INSERT INTO etudiants (`nom`, `prenom`, `numero`, `email`, `email_ins`, `mot_passe`, `role`) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $data['email'] = $data['email_ins']; // Remplacez email par email_ins
                unset($data['email_ins']); // Retirez email_ins du tableau
                $data['role'] = $role; // Ajoutez le rôle à la fin des valeurs
                $stmt = $this->db->getPDO()->prepare($sql);
                $stmt->execute(array_values($data));
            } else {
                throw new \Exception("Rôle non reconnu");
            }
        
            // Valide la transaction
            $this->db->getPDO()->commit();
            return true;

        } catch (\Exception $e) {
            // En cas d'erreur, annule la transaction
            header("location: /schl-hub/accueil");
            $this->db->getPDO()->rollBack();
            return false;
        }
        
    }
    
}