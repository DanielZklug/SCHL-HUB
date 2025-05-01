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
    public function findByIdStagiaire(int $id): ?Model{
        // Prépare une requête SQL pour récupérer un profil d'utilisateur spécifique par son ID
        $stmt = $this->db->getPDO()->prepare("
            SELECT
    -- Informations sur le stagiaire
    s.idStagiaire,
    s.Cla_idClasse,
    s.emailUni,
    DATE_FORMAT(s.date_inscription, '%d/%m/%Y à %Hh%imin%ss') AS date_inscription,
    su.nom AS Stagiaire_nom,
    su.idUtilisateur AS Stagiaire_UserId,
    su.prenom AS Stagiaire_prenom,
    su.photo AS Stagiaire_photo,
    su.numero AS Stagiaire_numero,
    su.email AS Stagiaire_email,
    su.role AS Stagiaire_role,
    su.genre AS Stagiaire_genre,

    -- Informations sur les notifications du stagiaire
    n.idNotification,
    n.titre AS notification_titre,
    n.description AS notification_description
     
FROM
    stagiaire s
JOIN utilisateur su ON s.Uti_idUtilisateur = su.idUtilisateur
LEFT JOIN notification n ON n.Uti_idUtilisateur = su.idUtilisateur  -- Jointure pour obtenir les notifications
WHERE
    s.Uti_idUtilisateur = ?;  -- Remplacer par l'ID de l'utilisateur stagiaire


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
    -- Informations de l'encadrant
    e.idEncadrant, 
    u.idUtilisateur,
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
    e.profession AS profession_encadrant,

    -- Informations sur les notifications du stagiaire
    n.idNotification,
    n.titre AS notification_titre,
    n.description AS notification_description

FROM
    utilisateur u
JOIN 
    encadrant e ON u.idUtilisateur = e.Uti_idUtilisateur
JOIN 
    profilsocial ps ON e.idEncadrant = ps.Enc_idEncadrant
LEFT JOIN 
    notification n ON u.idUtilisateur = n.Uti_idUtilisateur  -- Jointure pour récupérer les notifications de l'utilisateur
WHERE 
    u.idUtilisateur = ?;  -- Remplacer par l'ID de l'utilisateur encadrant


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

    public function getStagiairesByEncadrant(int $idEncadrant): array {
        // Prépare une requête SQL pour récupérer les stagiaires associés à un encadrant
        $stmt = $this->db->getPDO()->prepare("
                    SELECT
    -- Informations des stagiaires
    s.idStagiaire,
    su.nom AS Stagiaire_nom,
    su.prenom AS Stagiaire_prenom,
    su.photo AS Stagiaire_photo,
    su.numero AS Stagiaire_numero,
    su.email AS Stagiaire_email,
    su.role AS Stagiaire_role,
    s.emailUni AS Stagiaire_emailUni,
    s.Uti_idUtilisateur AS Stagiaire_idUtilisateur,  -- Ajout de l'idUtilisateur du stagiaire
    
    -- Informations de la classe
    c.idClasse AS Classe_idClasse,
    c.nom AS Classe_nom
FROM
    stagiaire s
JOIN
    utilisateur su ON s.Uti_idUtilisateur = su.idUtilisateur
JOIN
    encadrant e ON s.Enc_idEncadrant = e.idEncadrant
JOIN
    classe c ON s.Cla_idClasse = c.idClasse  -- Jointure pour obtenir les informations de la classe
WHERE
    e.Uti_idUtilisateur = ?;  -- Remplacer par l'ID de l'utilisateur encadrant

        ");
    
        // Exécute la requête avec l'ID de l'encadrant
        $stmt->execute([$idEncadrant]);
    
        // Récupère tous les résultats sous forme de tableau associatif
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
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

    public function insertStudent(array $data) {
        try {
            // Préparer la requête avec une jointure entre la table stagiaire et utilisateur
            $stmt = $this->db->getPDO()->prepare(
                "UPDATE {$this->table} AS s
                 JOIN utilisateur AS u ON u.email = :stagiaire_email
                 SET s.Enc_idEncadrant = :idEnc, 
                     s.Cla_idClasse = :idCla, 
                     s.date_inscription = NOW()
                 WHERE s.Uti_idUtilisateur = u.idUtilisateur 
                 AND u.role = 'etudiant'"
            );
    
            // Exécuter la requête en passant les valeurs de $data
            $stmt->execute([
                ':idEnc' => $data['idEnc'],               // id de l'encadrant
                ':idCla' => $data['idCla'],               // id de la classe
                ':stagiaire_email' => $data['stagiaire_email'], // email du stagiaire
            ]);
    
            // Vérifier si une ligne a été affectée (si aucune ligne n'est affectée, cela signifie que l'email ne correspond pas à un étudiant)
            if ($stmt->rowCount() > 0) {
                $_SESSION['success_message'] = "Stagiaire enregistré avec succès.";
            } else {
                $_SESSION['error_message'] = "Aucun étudiant trouvé avec cet email ou l'utilisateur n'est pas un étudiant.";
            }
        } catch (\Exception $e) {
            // Message d'erreur
            $_SESSION['error_message'] = "Erreur lors de la mise à jour des informations : " . $e->getMessage();
        }
    }
    
    

    public function getClassesByEncadrant(int $idEncadrant): array {
        // Prépare une requête SQL pour récupérer les classes associées à un encadrant
        $stmt = $this->db->getPDO()->prepare("
            SELECT
                c.idClasse,
                c.nom AS Classe_nom,
                c.Uti_idUtilisateur AS Classe_Uti_idUtilisateur,
                c.Enc_idEncadrant AS Classe_Enc_idEncadrant,
                DATE_FORMAT(c.dateCreation, '%d/%m/%Y à %Hh%imin%ss') AS Classe_dateCreation,
                COUNT(s.idStagiaire) AS Nombre_Stagiaires
            FROM
                {$this->table} c
            JOIN
                encadrant e ON c.Enc_idEncadrant = e.idEncadrant
            LEFT JOIN
                stagiaire s ON c.idClasse = s.Cla_idClasse
            WHERE
                e.Uti_idUtilisateur = ?
            GROUP BY
                c.idClasse;
        ");
    
        // Exécute la requête avec l'ID de l'encadrant
        $stmt->execute([$idEncadrant]);
    
        // Récupère tous les résultats sous forme de tableau associatif
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $result;
    }
    
    public function getEncadrantStatistics(int $idEncadrant): array {
        // Prépare une requête SQL pour récupérer les statistiques de l'encadrant
        $stmt = $this->db->getPDO()->prepare("
            SELECT
                COUNT(DISTINCT c.idClasse) AS Nombre_de_classes,
                COUNT(s.idStagiaire) AS Nombre_total_etudiants,
                COUNT(CASE WHEN su.genre = 'F' THEN 1 END) AS Nombre_de_filles,
                COUNT(CASE WHEN su.genre = 'M' THEN 1 END) AS Nombre_de_garcons
            FROM
                encadrant e
            JOIN
                classe c ON e.idEncadrant = c.Enc_idEncadrant
            LEFT JOIN
                stagiaire s ON c.idClasse = s.Cla_idClasse
            LEFT JOIN
                utilisateur su ON s.Uti_idUtilisateur = su.idUtilisateur
            WHERE
                e.Uti_idUtilisateur = ?;
        ");
    
        // Exécute la requête avec l'ID de l'encadrant
        $stmt->execute([$idEncadrant]);
    
        // Récupère le résultat sous forme de tableau associatif
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Si aucun résultat n'est trouvé, retourne un tableau vide
        if (!$result) {
            throw new NotFoundException("Aucune statistique trouvée pour l'encadrant avec l'ID : $idEncadrant");
        }
    
        return $result;
    }

    public function getClassById(int $idClasse): array {
        // Prépare une requête SQL pour récupérer les informations d'une classe spécifique
        $stmt = $this->db->getPDO()->prepare("
            SELECT 
                c.idClasse,
                c.nom,
                DATE_FORMAT(c.dateCreation, '%d/%m/%Y à %Hh%imin%ss') AS dateCreation
            FROM 
                classe c
            WHERE 
                c.idClasse = ?;
        ");
    
        // Exécute la requête avec l'ID de la classe
        $stmt->execute([$idClasse]);
    
        // Récupère le résultat sous forme de tableau associatif
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Si aucun résultat n'est trouvé, lève une exception
        if (!$result) {
            throw new \Exception("Aucune classe trouvée avec l'ID : $idClasse");
        }
    
        return $result;
    }
}