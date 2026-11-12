<?php

namespace Tacha\ViteEtGourmand\Repository;

use Tacha\ViteEtGourmand\Database;
use PDO;

class CompteRepository
{
    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

//INSERT dans la table comptes des informations d'inscritpion
    public function create(string $email, string $mot_de_passe_hash, string $nom, string $prenom, string $telephone, string $adresse, string $complement_adresse, string $code_postal, string $commune, string $role): void
    {
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare("INSERT INTO comptes (email, mot_de_passe_hash, nom, prenom, telephone, adresse, complement_adresse, code_postal, commune, `role`) VALUES (:email, :mot_de_passe_hash, :nom, :prenom, :telephone, :adresse, :complement_adresse, :code_postal, :commune, :role);
        ");

        $stmt->execute([
            ':email' => $email,
            ':mot_de_passe_hash' => $mot_de_passe_hash,
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':telephone' => $telephone,
            ':adresse' => $adresse,
            ':complement_adresse' => $complement_adresse,
            ':code_postal' => $code_postal,
            ':commune' => $commune,
            ':role' => $role
        ]);
    }

//SELECT qui renvoie les infos d'un utilisateur selon la correspondance d'email
    public function findByEmail(string $email): ?array
    {
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare("SELECT id, email, nom, prenom, mot_de_passe_hash, `role`, actif FROM comptes WHERE email = :email;
        ");

        $stmt->execute([
            ':email' => $email
        ]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }


//SELECT qui renvoie les infos de tous les comptes qui ont un rôle employé
    public function findAllEmploye(): array
    {
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare("SELECT id, email, nom, prenom, adresse, complement_adresse, code_postal, commune, telephone, actif, `role` FROM comptes WHERE `role` = 'employe';
        ");

        $stmt->execute([]);      
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
//UPDATE dans comptes du champ actif
    public function toggleActif(int $id): void {
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare("UPDATE comptes SET actif = NOT actif WHERE id = :id;
        ");

        $stmt->execute([
            ':id' => $id
        ]); 
    }

//SELECT qui renvoie les infos d'un comptes selon l'id
        public function findById(int $id) : ?array 
    {
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare("SELECT id, nom, prenom, email, telephone, adresse, complement_adresse, code_postal, commune  FROM comptes WHERE id = :id;");

        $stmt->execute(
            [
            ':id' => $id
            ]
        );

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
        
    }
//UPDATE qui met à jour les infos personnelles du client 
    public function update(string $email, string $nom, string $prenom, string $telephone, string $adresse, string $complement_adresse, string $code_postal, string $commune, int $id): void
    {
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare("UPDATE comptes SET email = :email, nom = :nom, prenom = :prenom, telephone = :telephone, adresse = :adresse, complement_adresse = :complement_adresse, code_postal = :code_postal, commune = :commune WHERE id = :id;
        ");

        $stmt->execute([
            ':id' => $id,
            ':email' => $email,
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':telephone' => $telephone,
            ':adresse' => $adresse,
            ':complement_adresse' => $complement_adresse,
            ':code_postal' => $code_postal,
            ':commune' => $commune,
        ]);
    }

//UPDATE du mot de passe d'un compte selon l'id
    public function updatePassword(string $hashedPassword, int $id): void 
    {
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare("UPDATE comptes SET mot_de_passe_hash = :hashedPassword WHERE id = :id;
        ");

        $stmt->execute([
            ':id' => $id,
            ':hashedPassword' => $hashedPassword
        ]); 
    }
}
