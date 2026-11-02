<?php

namespace Tacha\ViteEtGourmand\Repository;

use Tacha\ViteEtGourmand\Database;
use PDO;

class MenuRepository
{
    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

#Fonction récupérant les informations de chaque menu même vide    
    public function findAll(): array {
        $pdo = $this->database->getConnection();
        $menus = $pdo->prepare("SELECT id, nomMenu, theme, prix, `description`, nbPersonneMin, `image`, regime, stock FROM menus ;
        ");

        $menus->execute();

        $result = $menus->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function create(string $nameMenu, string $description, string $theme, int $persMin, float $price, string $conditions, string $regime, int $stock, string $image): void
    {
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare("INSERT INTO menus (nomMenu, `description`, theme, nbPersonneMin, prix, conditions, regime, stock, `image`) VALUES (:nomMenu, :description, :theme, :nbPersonneMin, :prix, :conditions, :regime, :stock, :image);
        ");

        $stmt->execute(
            [
            ':nomMenu' => $nameMenu,
            ':description' => $description,
            ':theme' => $theme,
            ':nbPersonneMin' => $persMin,
            ':prix' => $price,
            ':conditions' => $conditions,
            ':regime' => $regime,
            ':stock' => $stock,
            ':image' => $image
        ]
        );
    }

    public function delete(int $id): void 
    {
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare("DELETE FROM menus WHERE id = :id");

        $stmt->execute(
            [
            ':id' => $id
            ]
        );
        
    }

    public function findById(int $id) : ?array 
    {
        $pdo = $this->database->getConnection();
        $idMenu = $pdo->prepare("SELECT id, nomMenu, theme, prix, conditions, `description`, nbPersonneMin, `image`, allergenes, regime, stock FROM menus WHERE id = :id;");

        $idMenu->execute(
            [
            ':id' => $id
            ]
        );

        $result = $idMenu->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
        
    }

    //Méthode qui permet de mettre à jour les informations des menus suite à modification par l'admin/employé
    public function update(int $id, string $nomMenu, string $description, string $theme, int $nbPersonneMin, float $prix, string $conditions, string $regime, int $stock, string $image): void
    {
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare("UPDATE menus SET nomMenu = :nomMenu, `description` = :description, theme = :theme, nbPersonneMin = :nbPersonneMin, prix = :prix, conditions = :conditions, regime = :regime, stock = :stock, `image` = :image WHERE id = :id");

            $stmt->execute(
            [
            ':nomMenu' => $nomMenu,
            ':description' => $description,
            ':theme' => $theme,
            ':nbPersonneMin' => $nbPersonneMin,
            ':prix' => $prix,
            ':conditions' => $conditions,
            ':regime' => $regime,
            ':stock' => $stock,
            ':image' => $image,
            ':id' => $id
        ]
        ); 
    }

    //Méthode qui permet de trouver les menus en fonction des filtres renseignés
    public function findMenusFiltres(?string $theme, ?string $regime, ?int $persNb, ?float $priceMin, ?float $priceMax ): array 
    {
        $pdo = $this->database->getConnection();

        $sql = "SELECT id, nomMenu, theme, prix, `description`, `image`, nbPersonneMin, regime FROM menus WHERE 1 = 1";

        $params = [];

        if($theme !== null && $theme !== '') 
            {
                $sql .= " AND theme = :theme";
                $params['theme'] = $theme;
            }

        if($regime !== null && $regime !== '') 
            {
                $sql .= " AND regime = :regime";
                $params['regime'] = $regime;
            }

        if($persNb !== null && $persNb !== '') 
            {
                $sql .= " AND nbPersonneMin <= :persNb";
                $params['persNb'] = $persNb;
            }

        if($priceMin !== null && $priceMin !== '') 
            {
                $sql .= " AND prix >= :priceMin";
                $params['priceMin'] = $priceMin;
            }

        if($priceMax !== null && $priceMax !== '') 
            {
                $sql .= " AND prix <= :priceMax";
                $params['priceMax'] = $priceMax;
            }

        $stmt = $pdo->prepare($sql);

        $stmt->execute($params);

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }
    

    

}    