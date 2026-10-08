<?php

namespace Tacha\ViteEtGourmand\Repository;


use Tacha\ViteEtGourmand\Database;
use PDO;
use PDOException;

class CommandeRepository {
    
    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function create(string $numero, string $adresseLivraison, ?string $complementLivraison, string $codePostalLivraison, string $communeLivraison, string $datePrestation, string $heurePrestation, int $nbPersonneCommande, float $prixTotal, float $fraisLivraison, float $montantRemise, int $compte_id,  int $menu_id): int
    {
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare("INSERT INTO commandes (numero, adresseLivraison, complementLivraison, codePostalLivraison, communeLivraison, datePrestation, heurePrestation, nbPersonneCommande, prixTotal, fraisLivraison, montantRemise, menu_id, compte_id) VALUES (:numero, :adresseLivraison, :complementLivraison, :codePostalLivraison, :communeLivraison, :datePrestation, :heurePrestation, :nbPersonneCommande, :prixTotal, :fraisLivraison, :montantRemise, :menu_id, :compte_id);
        ");

        $stmt->execute(
            [
            ':numero' => $numero,
            ':adresseLivraison' => $adresseLivraison,
            ':complementLivraison' => $complementLivraison,
            ':codePostalLivraison' => $codePostalLivraison,
            ':communeLivraison' => $communeLivraison,
            ':datePrestation' => $datePrestation,
            ':heurePrestation' => $heurePrestation,
            ':nbPersonneCommande' => $nbPersonneCommande,
            ':prixTotal' => $prixTotal,
            ':fraisLivraison' => $fraisLivraison,
            ':montantRemise' => $montantRemise,
            ':menu_id' => $menu_id,
            ':compte_id' => $compte_id
        ]
        );

        $idCommande = $pdo->lastInsertId();
        return (int)$idCommande;
    }

    public function createHistoStatut(string $statut,int $commande_id): void
    {
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare("INSERT INTO histostatut (statut, commande_id) VALUES (:statut, :commande_id);
        ");

        $stmt->execute(
            [
            ':statut' => $statut,
            ':commande_id' => $commande_id
        ]
        );
    }

    public function saveCommande (string $numero, string $adresseLivraison, ?string $complementLivraison, string $codePostalLivraison, string $communeLivraison, string $datePrestation, string $heurePrestation, int $nbPersonneCommande, float $prixTotal, float $fraisLivraison, float $montantRemise, int $compte_id,  int $menu_id): void {

    $pdo = $this->database->getConnection();
    $pdo->beginTransaction();

    try {
        $idCommandeCreate = $this->create( $numero, $adresseLivraison, $complementLivraison, $codePostalLivraison, $communeLivraison, $datePrestation, $heurePrestation, $nbPersonneCommande, $prixTotal, $fraisLivraison, $montantRemise, $compte_id, $menu_id);
        $this->createHistoStatut("En attente de validation", $idCommandeCreate);
        $pdo->commit();
    } catch (PDOException $e) {
        $pdo->rollback();
        throw $e;
    }



    }
}