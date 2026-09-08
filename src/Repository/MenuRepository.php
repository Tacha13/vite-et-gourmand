<?php

namespace Tacha\ViteEtGourmand\Repository;

use Tacha\ViteEtGourmand\Database;
use PDO;

class MenuRepository
{
    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

#Fonction récupérant les informations de chaque menu même vide    
    public function findAll(): array {
        $pdo = $this->database->getConnection();
        $menus = $pdo->prepare("SELECT id, nomMenu, theme, prix FROM menus ;
        ");

        $menus->execute();

        $result = $menus->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function create(string $nameMenu, string $description, string $theme, int $persMin, int $price, string $conditions, string $regime, int $stock): void
    {
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare("INSERT INTO menus (nomMenu, `description`, theme, nbPersonneMin, prix, conditions, regime, stock) VALUES (:nomMenu, :description, :theme, :nbPersonneMin, :prix, :conditions, :regime, :stock);
        ");

        $stmt->execute(
            [
            ':nomMenu' => $nameMenu,
            ':description' => $description,
            ':theme' => $theme,
            ':nbPersonneMin' => $persMin,
            ':prix' => $price,
            ':conditions' => $conditions,
            ':regime' => $regime,
            ':stock' => $stock
        ]
        );
    }

    public function delete(int $id): void 
    {
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare("DELETE FROM menus WHERE id = :id");

        $stmt->execute(
            [
            ':id' => $id
            ]
        );
        
    }

       
    

    

}    