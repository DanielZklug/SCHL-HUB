<?php

namespace App\Models;

use PDO;
use App\Exceptions\NotFoundException;
use Database\DBConnexion;

abstract class Model{
    protected $db;
    protected $table;

    public function __construct(DBConnexion $db){
        
        $this->db = $db;
    }

    public function all(): array{
        // Exécute une requête SQL pour récupérer tous les utilisateurs et leurs profils, triés par ID d'utilisateur décroissant
        $stmt = $this->db->getPDO()->query("
            SELECT
                e.idEncadrant, 
                u.nom AS nom_utilisateur, 
                u.prenom AS prenom_utilisateur,  
                u.photo AS photo_utilisateur, 
                e.profession AS profession_encadrant
            FROM
                {$this->table} e
            JOIN utilisateur u ON e.Uti_idUtilisateur = u.idUtilisateur
            ORDER BY e.idEncadrant DESC
        ");
        $stmt->setFetchMode(PDO::FETCH_CLASS,get_class($this),[$this->db]);
        // Récupère tous les résultats de la requête
        return $stmt->fetchAll();
    }

    public function allStudent(int $id): array{
        try {
            $stmt = $this->db->getPDO()->prepare("
                SELECT 
                    s.idStagiaire,
                    u.nom AS nom_utilisateur, 
                    u.prenom AS prenom_utilisateur,  
                    u.photo AS photo_utilisateur,
                    u.numero AS numero_utilisateur,
                    u.email AS email_utilisateur
                FROM 
                    stagiaire s
                JOIN utilisateur u ON s.Uti_idUtilisateur = u.idUtilisateur
                JOIN encadrant e ON s.Enc_idEncadrant = e.idEncadrant
                WHERE s.Enc_idEncadrant = ?
            ");
            
            $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
            $stmt->execute([$id]); // Exécute la requête avec l'ID fourni
            $result = $stmt->fetch();
            // Vérifiez si des résultats ont été trouvés
            if (!$result) {
                return []; // Aucun stagiaire trouvé
            }
            
            return $result; // Retourner les résultats trouvés
        } catch (\Exception $e) {
            // Gestion des erreurs SQL
            $_SESSION["error_message"] = "Erreur lors de l'exécution de la requête : " . $e->getMessage();
            return []; // Retourner un tableau vide en cas d'erreur
        }
    }
    
    // public function delete(int $id){
    //     return $this->query("DELETE FROM {$this->table} WHERE id = ?", $id);
    // }

    public function query(string $sql, string|int $param = null, bool $single = null){
        $method = is_null($param) ? 'query' : 'prepare';

        if(strpos($sql, "DELETE") === 0 || strpos($sql, "UPDATE") === 0 || strpos($sql, "CREATE") === 0){
            $stmt = $this->db->getPDO()->$method($sql);
            $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this),[$this->db]);

            return $stmt->execute([$param]);
        }
        $fetch = is_null($single) ? 'fetchAll' : 'fetch';

        $stmt = $this->db->getPDO()->$method($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this),[$this->db]);

        if($method === 'query'){
            return $stmt->$fetch();
        }else{
            $stmt->execute([$param]);
            return $stmt->$fetch();
        }
    }    

    public function findById(int $id): ?Model{
        // Prépare une requête SQL pour récupérer un profil d'utilisateur spécifique par son ID
        $stmt = $this->db->getPDO()->prepare("
            SELECT
                e.idEncadrant, 
                u.nom AS nom_utilisateur, 
                u.prenom AS prenom_utilisateur,  
                u.photo AS photo_utilisateur,
                u.numero AS numero_utilisateur,
                u.email AS email_utilisateur,
                ps.gitlab AS gitlab, 
                ps.github AS github, 
                ps.facebook AS facebook, 
                ps.instagram AS instagram, 
                ps.google AS google,  
                e.emailOrg AS email_organisationnel,
                e.bio AS bio_encadrant,
                e.profession AS profession_encadrant
            FROM
                {$this->table} e
            JOIN utilisateur u ON e.Uti_idUtilisateur = u.idUtilisateur
            JOIN profilsocial ps ON e.idEncadrant = ps.Enc_idEncadrant
            WHERE e.idEncadrant = ?
            ORDER BY e.idEncadrant DESC
        ");
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
        $stmt->execute([$id]); // Exécute la requête avec l'ID fourni
        $result = $stmt->fetch();

        // Si aucun résultat n'est trouvé, lance une exception
        if (!$result) {
            throw new NotFoundException("Aucun enregistrement trouvé avec l'ID : $id");
        }

        return $result;
    }
    public function findProfil(int $id): ?Model{
        // Prépare une requête SQL pour récupérer un profil d'utilisateur spécifique par son ID
        $stmt = $this->db->getPDO()->prepare("
            SELECT
                e.idEncadrant, 
                u.nom AS nom_utilisateur, 
                u.prenom AS prenom_utilisateur,  
                u.photo AS photo_utilisateur,
                u.numero AS numero_utilisateur,
                u.email AS email_utilisateur,
                ps.gitlab AS gitlab, 
                ps.github AS github, 
                ps.facebook AS facebook, 
                ps.instagram AS instagram, 
                ps.google AS google,  
                e.emailOrg AS email_organisationnel,
                e.bio AS bio_encadrant,
                e.profession AS profession_encadrant
            FROM
                utilisateur u
            JOIN {$this->table} e ON u.idUtilisateur = e.Uti_idUtilisateur
            JOIN profilsocial ps ON e.idEncadrant = ps.Enc_idEncadrant
            WHERE u.idUtilisateur = ?
        ");
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
        $stmt->execute([$id]); // Exécute la requête avec l'ID fourni
        $result = $stmt->fetch();

        // Si aucun résultat n'est trouvé, lance une exception
        if (!$result) {
            throw new NotFoundException("Aucun enregistrement trouvé");
        }

        return $result;
    }

    // public function countByGender(?string $gender = null): int{
    //     $sql = "SELECT COUNT(*) as count FROM {$this->table}";
    //     $params = [];

    //     if ($gender !== null) {
    //         $sql .= " WHERE genre = ?";
    //         $params[] = $gender;
    //     }

    //     $stmt = $this->db->getPDO()->prepare($sql);
    //     $stmt->execute($params);
    //     $result = $stmt->fetch(PDO::FETCH_ASSOC);

    //     return (int) $result['count'];
    // }

    public function insertFile(int $userId) {
        try {
            // Préparation de la requête avec un paramètre lié pour éviter l'injection SQL
            $stmt = $this->db->getPDO()->prepare("UPDATE {$this->table} SET photo = ? WHERE idUtilisateur = ?");
            
            // Lier les paramètres
            $stmt->execute([$_SESSION['file_name'], $userId]); // Exécute la requête avec le nom de fichier et l'ID utilisateur
    
            // Vérifiez si la mise à jour a réussi
            if ($stmt->rowCount() === 0) {
                throw new NotFoundException("Aucun enregistrement trouvé ou aucune modification effectuée");
            }
            
            return true; // Indique que l'insertion a réussi
        } catch (\Exception $e) {
            // Gérer l'erreur en enregistrant le message d'erreur dans la session
            if (session_status() === PHP_SESSION_NONE) {
                session_start(); // Démarre la session si elle n'est pas déjà démarrée
            }
            $_SESSION['error_message'] = "Erreur lors de l'insertion du fichier : " . $e->getMessage();
            
            // Optionnel : journaliser l'erreur pour le débogage
            error_log("Insertion de fichier échouée : " . $e->getMessage());
            
            return false; // Échec de l'insertion
        }
    }
    
    public function update($userId, array $data) {
        try {
            // Préparer et exécuter la requête
            $stmt = $this->db->getPDO()->prepare("UPDATE {$this->table} SET emailOrg = ?, bio = ?, profession = ? WHERE Uti_idUtilisateur = ?");
            
            // Passer explicitement les valeurs de $data dans le bon ordre
            $stmt->execute([
                $data['email_organisationnel'],    // emailOrg
                $data['bio_encadrant'],         // bio
                $data['profession_encadrant'],  // profession
                $userId               // idUtilisateur
            ]);
    
            $_SESSION['success_message'] = "Informations sur le compte mises à jour avec succès.";
        } catch (\Exception $e) {
            $_SESSION['error_message'] = "Erreur lors de la mise à jour des informations : " . $e->getMessage();
        }
    }
    
    
}