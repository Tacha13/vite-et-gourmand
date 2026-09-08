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

       
    

    

}    