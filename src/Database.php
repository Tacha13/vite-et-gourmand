<?php
namespace Tacha\ViteEtGourmand;

use PDO;

class Database {
    private PDO $pdo;

    public function __construct() {
        $host = $_ENV['DB_HOST'];
        $dbname = $_ENV['DB_NAME'];
        $user = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASSWORD'];

        $this->pdo = new PDO(
            "mysql:host=$host;port={$_ENV['DB_PORT']};dbname=$dbname;charset=utf8mb4",
            $user,
            $password
        );
    }

    public function getConnection(): PDO {
        return $this->pdo;
    }
}