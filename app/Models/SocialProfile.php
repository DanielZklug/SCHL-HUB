<?php
namespace App\Models;

class SocialProfile extends Model {
    protected $table = 'profilsocial';

    public function updateSocial(array $data) {
        try {
            // Mettre à jour les profils sociaux existants
            $stmt = $this->db->getPDO()->prepare("
                UPDATE {$this->table} 
                SET facebook = :facebook, 
                    instagram = :instagram, 
                    google = :google, 
                    github = :github, 
                    gitlab = :gitlab 
                WHERE Enc_idEncadrant = :user_id
            ");
             
            // Exécuter la requête avec les données fournies
            $stmt->execute([
                ':facebook' => $data['facebook'],
                ':instagram' => $data['instagram'],
                ':google' => $data['google'],
                ':github' => $data['github'],
                ':gitlab' => $data['gitlab'],
                ':user_id' => $data['user_id']
            ]);

            return true;
        } catch (\Exception $e) {
            // Journaliser l'erreur pour le débogage
            error_log("Erreur lors de la mise à jour ou de l'insertion des profils sociaux : " . $e->getMessage());
        }
    }
}
