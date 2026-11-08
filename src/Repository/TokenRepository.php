<?php

namespace Tacha\ViteEtGourmand\Repository;

use Tacha\ViteEtGourmand\Database;
use PDO;

class TokenRepository {
    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function deleteToken(int $compte_id): void
    {
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare("DELETE FROM token_mdp WHERE compte_id = :compte_id");

        $stmt->execute(
            [
            ':compte_id' => $compte_id
            ]
        );
        
    }

    
    public function create(string $token, int $compte_id): void
    {
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare("INSERT INTO token_mdp (token, date_expiration, compte_id) VALUES (:token, DATE_ADD(NOW(), INTERVAL 1 HOUR), :compte_id);
        ");

        $stmt->execute([
            ':token' => $token,
            ':compte_id' => $compte_id
        ]);

    }

    public function findByToken(string $token): ?array
    {
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare("SELECT compte_id FROM token_mdp WHERE token = :token AND NOW() BETWEEN  date_creation AND date_expiration;");

        $stmt->execute([
            ':token' => $token
        ]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }
    
}