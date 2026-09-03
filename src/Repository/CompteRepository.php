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

    public function create(string $email, string $mot_de_passe_hash, string $nom, string $prenom, string $telephone, string $adresse, string $complement_adresse, string $code_postal, string $commune): void
    {
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare("INSERT INTO comptes (email, mot_de_passe_hash, nom, prenom, telephone, adresse, complement_adresse, code_postal, commune) VALUES (:email, :mot_de_passe_hash, :nom, :prenom, :telephone, :adresse, :complement_adresse, :code_postal, :commune);
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
            ':commune' => $commune
        ]);
    }

    public function findByEmail(string $email): ?array
    {
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare("SELECT id, email, mot_de_passe_hash, `role` FROM comptes WHERE email = :email;
        ");

        $stmt->execute([
            ':email' => $email
        ]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }
}
