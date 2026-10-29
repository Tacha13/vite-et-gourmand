<?php

namespace Tacha\ViteEtGourmand\Repository;

use Tacha\ViteEtGourmand\Database;
use PDO;

class AllergeneRepository
{
    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

#Fonction récupérant les informations de chaque allergène même vide    
    public function findAll(): array {
        $pdo = $this->database->getConnection();
        $allergenes = $pdo->prepare("SELECT id, nomAllergene FROM allergenes ;
        ");

        $allergenes->execute();

        $result = $allergenes->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function create(string $nameAllergene): void
    {
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare("INSERT INTO allergenes (nomAllergene) VALUES (:nomAllergene);
        ");

        $stmt->execute(
            [
            ':nomAllergene' => $nameAllergene,
        ]
        );
    }

    public function delete(int $id): void 
    {
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare("DELETE FROM allergenes WHERE id = :id");

        $stmt->execute(
            [
            ':id' => $id
            ]
        );
        
    }

    #Fonction qui récupère les informations d'un allergène selon son id
    public function findById(int $id) : ?array 
    {
        $pdo = $this->database->getConnection();
        $idAllergene = $pdo->prepare("SELECT id, nomAllergene FROM allergenes WHERE id = :id;");

        $idAllergene->execute(
            [
            ':id' => $id
            ]
        );

        $result = $idAllergene->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }  
       
    //Méthode qui permet de mettre à jour les informations des allergènes suite à modification par l'admin/employé
    public function update(int $id, string $nomAllergene): void
    {
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare("UPDATE allergenes SET nomAllergene = :nomAllergene WHERE id = :id");

        $stmt->execute(
        [
            ':nomAllergene' => $nomAllergene,
            ':id' => $id
        ]
        ); 
    }
}    