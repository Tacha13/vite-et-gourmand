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

//SELECT des allergènes dans la table allergenes, et renvoie tous les allergènes
    public function findAll(): array {
        $pdo = $this->database->getConnection();
        $allergenes = $pdo->prepare("SELECT id, nomAllergene FROM allergenes ;
        ");

        $allergenes->execute();

        $result = $allergenes->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

//INSERT du nom de l'allergène dans la table allergenes
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

//DELETE de l'allergène
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

//SELECT de l'allergène et son id dans la table allergenes en fon ction de son id, et renvoie l'allergène ou null si introuvable
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
       
//UPDATE du nom de l'allergène correspond à l'id
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