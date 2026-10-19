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

    public function saveCommande (string $numero, string $adresseLivraison, ?string $complementLivraison, string $codePostalLivraison, string $communeLivraison, string $datePrestation, string $heurePrestation, int $nbPersonneCommande, float $prixTotal, float $fraisLivraison, float $montantRemise, int $compte_id,  int $menu_id): string 
    {

    $pdo = $this->database->getConnection();
    $pdo->beginTransaction();

    try {
        $idCommandeCreate = $this->create( $numero, $adresseLivraison, $complementLivraison, $codePostalLivraison, $communeLivraison, $datePrestation, $heurePrestation, $nbPersonneCommande, $prixTotal, $fraisLivraison, $montantRemise, $compte_id, $menu_id);
        $numeroFinal = "CMD-" . date('Y') . "-" . $idCommandeCreate;
        $this->updateNumero($idCommandeCreate, $numeroFinal);
        $this->createHistoStatut("En attente de validation", $idCommandeCreate);
        $pdo->commit();
        return (string)$numeroFinal;
    } catch (PDOException $e) {
        $pdo->rollback();
        throw $e;
    }
    }

    public function findCommandesByCompteId(int $compteId) : array 
    {
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare("SELECT c.numero, m.nomMenu,  c.statut, c.adresseLivraison, c.complementLivraison, c.codePostalLivraison, c.communeLivraison, c.datePrestation,  c.heurePrestation, c.nbPersonneCommande, c.prixTotal, c.fraisLivraison,  c.montantRemise, c.motifAnnulation, c.dateCreation, c.id, a.id AS avis_id
		FROM commandes c INNER JOIN menus m ON c.menu_id = m.id LEFT JOIN avis a ON a.commande_id =c.id  WHERE c.compte_id = :compteId ORDER BY c.datePrestation DESC;");

        $stmt->execute(
            [
            ':compteId' => $compteId
            ]);      


        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
        
    }

    public function updateNumero (int $id,string $numero): void {
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare("UPDATE commandes SET numero = :numero WHERE id = :id");

                $stmt->execute(
            [
            ':numero' => $numero,
            ':id' => $id
        ]
        );
    }

    //Fonction qui renvoie sous forme de tableau l'ensemble des commandes quel que soit le statut pour l'employé afin de modifier ou annuler une commande, triée par date de prestation et heure de prestation (ASC non nécessaire car par défaut, du plus proche au plus lointain)
    public function findAllCommandesEmploye(): array 
    {
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare("SELECT c.id, c.numero, c.dateCreation, c.datePrestation, c.heurePrestation, c.statut, m.nomMenu, co.nom, co.prenom, co.telephone, co.email FROM commandes c, menus m, comptes co WHERE c.menu_id = m.id AND c.compte_id = co.id ORDER BY c.datePrestation, c.heurePrestation;");

        $stmt->execute([]);    
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
        
    }
}