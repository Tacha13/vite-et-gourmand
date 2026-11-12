<?php
namespace Tacha\ViteEtGourmand;

use PDO;

class Database {
    private PDO $pdo;

//Fonction qui permet de se connecter à la base MySQL avec les infos renseignées dans le fichier .env
    public function __construct() {
        $host = $_ENV['DB_HOST'];
        $port = $_ENV['DB_PORT'];
        $dbname = $_ENV['DB_NAME'];
        $user = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASSWORD'];

        $this->pdo = new PDO(
            "mysql:host=$host;port={$port};dbname=$dbname;charset=utf8mb4",
            $user,
            $password
        );
    }

//Fonction qui renvoie la connexion créé
    public function getConnection(): PDO {
        return $this->pdo;
    }
}