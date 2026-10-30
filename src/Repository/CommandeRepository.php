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

    //Fonction qui renvoie sous forme de tableau l'ensemble des commandes sous forme de filtre pour l'employé afin de modifier ou annuler une commande, triée par date de prestation et heure de prestation (ASC non nécessaire car par défaut, du plus proche au plus lointain). 
    public function findAllCommandesEmploye(string $statut, string $nom): array 
    {
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare("SELECT c.id, c.numero, c.dateCreation, c.datePrestation, c.heurePrestation, c.statut, m.nomMenu, co.nom, co.prenom, co.telephone, co.email FROM commandes c, menus m, comptes co WHERE c.menu_id = m.id AND c.compte_id = co.id AND (:statut = '' OR c.statut = :statut) AND (co.nom LIKE :nom) ORDER BY c.datePrestation, c.heurePrestation;");

        $stmt->execute(
            [
                ':statut' => $statut,
                ':nom' => $nom . '%'
            ]);    

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
        
    }

    //Fonction mettant à jour le statut de la commande après modification par l'admin ou l'employé, met à jour la table commandes
    public function updateStatutCommande(int $id, string $statut): void 
    {
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare("UPDATE commandes SET statut = :statut WHERE id = :id");

            $stmt->execute(
            [
            ':statut' => $statut,
            ':id' => $id
        ]
        ); 
    }

    //Fonction qui met à jour les statut de la commande dans la commande et l'historique des commandes, si le try n'exécute pas un des appels le catch annule tout avec un rollback et une erreur est envoyée au controller
    public function updateStatutHistoCommande(int $id, string $statut): void
    {
    $pdo = $this->database->getConnection();
    $pdo->beginTransaction();

    try {
        $this->updateStatutCommande($id, $statut);
        $this->createHistoStatut($statut, $id);
        $pdo->commit();
    } catch (PDOException $e) {
        $pdo->rollback();
        throw $e;
    }
    }

    //Fonction qui enregistre le motif d'annulation de commandes et le mode de contact
    public function updateMotifAnnulContactCommande(int $id, string $motifAnnulation, string $modeContact): void
    {
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare("UPDATE commandes SET motifAnnulation = :motifAnnulation, modeContact = :modeContact WHERE id = :id");

            $stmt->execute(
            [
            ':motifAnnulation' => $motifAnnulation,
            ':modeContact' => $modeContact,
            ':id' => $id
        ]
        ); 

    }

    //Fonction qui met à jour le motif d'annulation  et le mode de contact dans la commande et l'historique, si le try n'exécute pas un des appels le catch annule tout avec un rollback et une erreur est envoyée au controller
    public function updateMotifContactHistoCommande(int $id, string $statut, string $motifAnnulation, string $modeContact): void 
    {
        $pdo = $this->database->getConnection();
        $pdo->beginTransaction();

        try {
            $this->updateStatutCommande($id, $statut);
            $this->createHistoStatut($statut, $id);
            $this->updateMotifAnnulContactCommande($id, $motifAnnulation, $modeContact);
            $pdo->commit();
        } catch (PDOException $e) {
            $pdo->rollback();
            throw $e;
        }
    }

    #Fonction qui récupère les informations d'une commande pour création d'une fiche à destination de mongodb
    public function findCommandeById(int $id) : ?array 
    {
        $pdo = $this->database->getConnection();
        $idCommandeMongo = $pdo->prepare("SELECT c.id, c.numero, c.prixTotal, c.datePrestation, m.nomMenu FROM commandes c, menus m WHERE c.id = :id AND c.menu_id = m.id;");

        $idCommandeMongo->execute(
            [
            ':id' => $id,
            ]
        );

        $result = $idCommandeMongo->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    } 
    
}