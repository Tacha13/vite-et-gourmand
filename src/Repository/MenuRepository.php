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


}    