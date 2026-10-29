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

    #Fonction qui récupère les informations d'un horaire selon son id
    public function findById(int $id) : ?array 
    {
        $pdo = $this->database->getConnection();
        $idHoraire = $pdo->prepare("SELECT id, jour, heureDebut, heureFin, ouvert FROM horaires WHERE id = :id;");

        $idHoraire->execute(
            [
            ':id' => $id
            ]
        );

        $result = $idHoraire->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    } 

    //Méthode qui permet de mettre à jour les informations des horaires suite à modification par l'admin/employé
    public function update(int $id, ?string $heureDebut, ?string $heureFin, int $ouvert): void
    {
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare("UPDATE horaires SET heureDebut = :heureDebut, heureFin = :heureFin, ouvert = :ouvert WHERE id = :id");

            $stmt->execute(
            [
            ':heureDebut' => $heureDebut,
            ':heureFin' => $heureFin,
            ':ouvert' => $ouvert,
            ':id' => $id
        ]
        ); 
    }
}