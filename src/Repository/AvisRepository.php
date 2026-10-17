<?php

namespace Tacha\ViteEtGourmand\Repository;

use Tacha\ViteEtGourmand\Database;
use PDO;

class AvisRepository {
    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

   public function create (string $avis, int $note, int $commande_id): void {

    $pdo = $this->database->getConnection();
    $stmt = $pdo->prepare("INSERT INTO avis (avis, note, commande_id) VALUES (:avis, :note, :commande_id )");

    $stmt->execute(
            [
            ':avis' => $avis,
            ':note' => $note,
            ':commande_id' => $commande_id
        ]
        );
   }

   public function canCommandeReceiveAvis (int $commandeId, int $compteId): bool {
    
   $pdo = $this->database->getConnection();
    $stmt = $pdo->prepare("SELECT  c.id FROM commandes c LEFT JOIN avis a ON a.commande_id = c.id  WHERE c.id = :commandeId AND c.compte_id = :compteId AND c.statut = 'Terminée' AND a.id IS NULL;");
   
   $stmt->execute(
    [
        ':commandeId' => $commandeId,
        ':compteId' => $compteId
    ]
   );

    $result = $stmt->fetch();
    return $result !== false;

   }
}