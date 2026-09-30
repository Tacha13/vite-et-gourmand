<?php

namespace Tacha\ViteEtGourmand\Controller;


use Tacha\ViteEtGourmand\Repository\CompteRepository;
use Tacha\ViteEtGourmand\Repository\MenuRepository;

class CommandeController 
{
    const TAUX_REMISE = 0.10;
    const PRIX_KM = 0.59;
    const FRAIS_FIXE = 5;

    const CODES_POSTAUX_BORDEAUX = ['33000', '33100', '33200', '33300', '33800'];
    const CODES_POSTAUX_METROPOLE = ['33440', '33810', '33370', '33530', '33130','33290', '33270', '33110', '33520', '33560','33150', '33320', '33170', '33185', '33310','33127', '33700', '33600', '33160', '33400', '33140'];

    const FORFAIT_KM_METROPOLE = 10;
    const FORFAIT_KM_GIRONDE = 40;

    
    private CompteRepository $compteRepository;
    private MenuRepository $menuRepository;

    
    public function __construct(CompteRepository $compteRepository, MenuRepository $menuRepository)
    {
        $this->compteRepository = $compteRepository;
        $this->menuRepository = $menuRepository;
    }

    //Route qui récupère les infos d'un client et du menu avec findById et renvoie à la page de commande   
    public function showCommandeCreate(): void 
    {


        if(!isset($_GET['menu_id'])) {
            header('location:http://localhost:8000/?page=menus');
            exit;
        } 
            $idMenu = $this->menuRepository->findById((int)$_GET['menu_id']);
            

        if (!$idMenu) {
            header('location:http://localhost:8000/?page=menus');
            exit;
        }
            $idClient = $this->compteRepository->findById($_SESSION['user_id']);
            require __DIR__ . '/../../templates/client/commande_create.php';

        
    }

    //Route qui prépare la création de la commande en vérifiant les données
    public function prepareCommande (): void
    {   
        if(!isset($_GET['menu_id'])) {
            header('location:http://localhost:8000/?page=menus');
            exit;
        } 
        $idMenu = $this->menuRepository->findById((int)$_GET['menu_id']);

        if (!$idMenu) {
            header('location:http://localhost:8000/?page=menus');
            exit;
        }
        
        $nombreCommande = ((int)$_POST['nombreCommande']);
        $adressLivraison = htmlspecialchars($_POST['adressLivraison']);
        $moreAdressLivraison = htmlspecialchars($_POST['moreAdressLivraison']);
        $postalLivraison = htmlspecialchars($_POST['postalLivraison']);
        $cityLivraison = htmlspecialchars($_POST['cityLivraison']);
        $datePrestation = htmlspecialchars($_POST['datePrestation']);
        $heurePrestation = htmlspecialchars($_POST['heurePrestation']);

        if ($nombreCommande < $idMenu['nbPersonneMin']) {
            $_SESSION['erreurMinPersonne'] = "Le nombre de convives est insuffisant";
            header('location:http://localhost:8000/?page=commande_create&menu_id=' . $idMenu['id']);
            exit;
        } 

        if ($datePrestation < date('Y-m-d', strtotime('+2DAY'))) {
            $_SESSION['erreurDateLivraison'] = "La date de livraison est trop proche, veuillez respecter 2 jours entre la date du jour et la livraison";
            header('location:http://localhost:8000/?page=commande_create&menu_id=' . $idMenu['id']);
            exit;
        } 

        $prixMenu =  $idMenu['prix'] * $nombreCommande;

        if ($nombreCommande >= ($idMenu['nbPersonneMin'] +5) ) {
            $remise = $prixMenu * self::TAUX_REMISE;
        } else { 
            $remise = 0.00;
        }

        if ( in_array( $postalLivraison, self::CODES_POSTAUX_BORDEAUX)) {
            $frais = 0;
        } elseif (in_array($postalLivraison, self::CODES_POSTAUX_METROPOLE)) {
            $frais = self::FRAIS_FIXE + (self::FORFAIT_KM_METROPOLE * self::PRIX_KM);
        } elseif (!in_array( $postalLivraison, self::CODES_POSTAUX_METROPOLE) && !in_array( $postalLivraison, self::CODES_POSTAUX_BORDEAUX ) && str_starts_with( $postalLivraison,'33')) {
            $frais = self::FRAIS_FIXE + (self::FORFAIT_KM_GIRONDE * self::PRIX_KM);
        } else {
            $_SESSION['messageHorsLimite'] = "Nous ne livrons pas en dehors de la zone de livraison";
            header('location:http://localhost:8000/?page=commande_create&menu_id=' . $idMenu['id']);
            exit;
        }

        $prixTotalCommande = round(($prixMenu + $frais) - $remise, 2);

        $_SESSION ['commande'] = ([
            'idMenu' => $idMenu['id'],
            'nombreCommande' => $nombreCommande,
            'adressLivraison' => $adressLivraison,
            'moreAdressLivraison' => $moreAdressLivraison,
            'postalLivraison' => $postalLivraison,
            'cityLivraison' => $cityLivraison,
            'datePrestation' => $datePrestation,
            'heurePrestation' => $heurePrestation,
            'prixMenu' => $prixMenu,
            'frais' => $frais,
            'remise' => $remise,
            'prixTotalCommande' => $prixTotalCommande
        ]);

            header('location:http://localhost:8000/?page=commande_validate');
            exit;
    }
    

}