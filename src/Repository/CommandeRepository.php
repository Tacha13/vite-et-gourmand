<?php

namespace Tacha\ViteEtGourmand\Repository;

use DateTime;
use Tacha\ViteEtGourmand\Database;
use PDO;

class CommandeRepository {
    
    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function create(string $numero, string $adresseLivraison, ?string $complementLivraison, string $codePostalLivraison, string $communeLivraison, string $datePrestation, string $heurePrestation, int $nbPersonneCommande, float $prixTotal, float $fraisLivraison, float $montantRemise, int $compte_id,  int $menu_id): void
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
    }
}