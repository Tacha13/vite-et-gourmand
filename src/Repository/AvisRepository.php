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

   public function findAllAvisByStatut (string $statutAvis): array {

    $pdo = $this->database->getConnection();
    $stmt = $pdo->prepare("SELECT a.avis, a.note, a.statutAvis, a.id, c.numero, m.nomMenu, co.nom, co.prenom FROM avis a, commandes c, menus m, comptes co WHERE a.commande_id = c.id AND c.menu_id = m.id AND c.compte_id = co.id AND a.statutAvis = :statutAvis");

    $stmt->execute([
        ':statutAvis' => $statutAvis
    ]);      
        
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
    }

    public function updateAvis(int $id, string $statutAvis): void
    {
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare("UPDATE avis SET statutAvis = :statutAvis WHERE id = :id;
        ");

        $stmt->execute([
			':id' => $id,
            ':statutAvis' => $statutAvis,
        ]);
    }


}