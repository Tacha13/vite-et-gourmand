<?php

namespace Tacha\ViteEtGourmand\Repository;

use Tacha\ViteEtGourmand\Database;
use PDO;

class HoraireRepository 
{
    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    #Fonction récupérant les informations des horaires même vide    
    public function findAll(): array {
        $pdo = $this->database->getConnection();
        $horaires = $pdo->prepare("SELECT id, jour, heureDebut, heureFin, ouvert FROM horaires ORDER BY id;
        ");

        $horaires->execute();

        $result = $horaires->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}