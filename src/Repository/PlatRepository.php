<?php

namespace Tacha\ViteEtGourmand\Repository;

use Tacha\ViteEtGourmand\Database;
use PDO;

class PlatRepository
{
    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

#Fonction récupérant les informations de chaque plat même vide    
    public function findAll(): array {
        $pdo = $this->database->getConnection();
        $plats = $pdo->prepare("SELECT id, nomPlat, typePlat FROM plats ;
        ");

        $plats->execute();

        $result = $plats->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function create(string $namePlat, string $typePlat): void
    {
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare("INSERT INTO plats (nomPlat, typePlat) VALUES (:nomPlat, :typePlat);
        ");

        $stmt->execute(
            [
            ':nomPlat' => $namePlat,
            ':typePlat' => $typePlat
        ]
        );
    }

    public function delete(int $id): void 
    {
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare("DELETE FROM plats WHERE id = :id");

        $stmt->execute(
            [
            ':id' => $id
            ]
        );
        
    }

    public function findById(int $id) : ?array 
    {
        $pdo = $this->database->getConnection();
        $idPlat = $pdo->prepare("SELECT id, nomPlat, typePlat FROM plats WHERE id = :id;");

        $idPlat->execute(
            [
            ':id' => $id
            ]
        );

        $result = $idPlat->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }  
    
     //Méthode qui permet de mettre à jour les informations des plats suite à modification par l'admin/employé
    public function update(int $id, string $nomPlat, string $typePlat): void
    {
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare("UPDATE plats SET nomPlat = :nomPlat, typePlat = :typePlat WHERE id = :id");

            $stmt->execute(
            [
            ':nomPlat' => $nomPlat,
            ':typePlat' => $typePlat,
            ':id' => $id
        ]
        ); 
    }
    

}    