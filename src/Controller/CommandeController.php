<?php

namespace Tacha\ViteEtGourmand\Controller;

use PDOException;
use Tacha\ViteEtGourmand\Repository\CompteRepository;
use Tacha\ViteEtGourmand\Repository\MenuRepository;
use Tacha\ViteEtGourmand\Repository\CommandeRepository;
use Tacha\ViteEtGourmand\Service\MailService;



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
    private CommandeRepository $commandeRepository;
    private MailService $mailService;

    
    public function __construct(CompteRepository $compteRepository, MenuRepository $menuRepository, CommandeRepository $commandeRepository, MailService $mailservice)
    {
        $this->compteRepository = $compteRepository;
        $this->menuRepository = $menuRepository;
        $this->commandeRepository = $commandeRepository;
        $this->mailService = $mailservice;
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

    //Route qui récupère les infos du panier avec findById et renvoie à la page de validation de la commande   
    public function showCommandeValidate(): void 
    {
        if(!isset($_SESSION ['commande'] )) {
            header('location:http://localhost:8000/?page=menus');
            exit;
        } 
            $idMenu = $this->menuRepository->findById((int)$_SESSION['commande']['idMenu']);

        if (!$idMenu) {
            header('location:http://localhost:8000/?page=menus');
            exit;
        }
            require __DIR__ . '/../../templates/client/commande_validate.php';
    }


     //Fonction qui sauvegarde la commande et envoie au client le message de confirmation ou non  
    public function createCommande(): void 
    {
        if(!isset($_SESSION ['commande'] )) {
            header('location:http://localhost:8000/?page=menus');
            exit;
        } 

        //Numéro provisoire en attendant d'insérer l'id de la commande
        //$numero = "CMD-" . date('Y') . "-" . random_int(1000,9999);
        $numero = uniqid("TMP");
        
        try {
        $numero = $this->commandeRepository->saveCommande(
            $numero,
            $_SESSION ['commande']['adressLivraison'],
            $_SESSION ['commande']['moreAdressLivraison'] ?: null,
            $_SESSION ['commande']['postalLivraison'],
            $_SESSION ['commande']['cityLivraison'],
            $_SESSION ['commande']['datePrestation'],
            $_SESSION ['commande']['heurePrestation'],
            $_SESSION ['commande']['nombreCommande'],
            $_SESSION ['commande']['prixTotalCommande'],
            $_SESSION ['commande']['frais'],
            $_SESSION ['commande']['remise'],
            $_SESSION ['user_id'],
            $_SESSION ['commande']['idMenu']
        );

            $menu = $this->menuRepository->findById((int)$_SESSION['commande']['idMenu']);
            $nameMenu = $menu['nomMenu'];

            $body = "Bonjour " . $_SESSION['user_prenom'] . " " . $_SESSION['user_nom'] . ", Nous vous remercions pour votre commande du " . $nameMenu . ", numéro : " . $numero . "." . "Vous trouverez ci-dessous le détail de votre sélection :" . "\n" . 
                    "Adresse de livraison : " . "\n" . 
                    "Adresse : " . $_SESSION ['commande']['adressLivraison'] . "," . "\n" . 
                    "Complément adresse : " . $_SESSION ['commande']['moreAdressLivraison'] . "," . "\n" .
                    "Code Postal : " . $_SESSION ['commande']['postalLivraison'] . "," . "\n" .
                    "Commune : " . $_SESSION ['commande']['cityLivraison'] . "." . "\n" .
                    "La date de livraison est prévue le : " . "\n" .
                    $_SESSION ['commande']['datePrestation'] . "," . "\n" .
                    "à : " . "\n" .
                    $_SESSION ['commande']['heurePrestation'] . "." . "\n" .
                    "Le nombre de convives est : " . "\n" .
                    $_SESSION ['commande']['nombreCommande'] . " personnes." . "\n" .
                    "Ci-dessous le détail de votre commande : " . "\n" .
                    "Prix total : " . $_SESSION ['commande']['prixTotalCommande'] . "€" . "," . "\n" .
                    "Frais de livraison : " . $_SESSION ['commande']['frais'] . "€"  . "," . "\n" .
                    "Remise : " . $_SESSION ['commande']['remise'] . "€"  . "," . "\n" . "";

            // Renvoie true ou false si le mail est parti ou non
            $answerCommande = $this->mailService->sendMail($_SESSION['user_email'], 'Confirmation commande, numéro : ' . $numero, $body);

            if ($answerCommande == true) {
                $_SESSION['commandeSuccess'] = "La commande est validée";
            } else {
                $_SESSION['mailCommandeFailure'] = "La commande a bien été prise en compte. Le mail de confirmation n'a pas pu être envoyé. N'hésitez pas à contacter notre équipe si besoin";
            } 
            unset($_SESSION['commande']);
            header('location:http://localhost:8000/?page=home');
            exit;
        } 
        catch (PDOException $e) { 
            $_SESSION['commandeErreur'] = "La commande a échoué";
            header('location:http://localhost:8000/?page=commande_validate');
            exit;
        }
    }

    public function showAllCommandesClient (): void
    {
        if(!isset($_SESSION ['user_id'] )) {
            header('location:http://localhost:8000/?page=login');
            exit;
        } 

        $allCommandes = $this->commandeRepository->findCommandesByCompteId($_SESSION['user_id']);

        require __DIR__ . '/../../templates/client/compte_client.php';
    }

        public function showAllHistoCommandesClient (): void
    {
        if(!isset($_SESSION ['user_id'] )) {
            header('location:http://localhost:8000/?page=login');
            exit;
        } 

        $allCommandes = $this->commandeRepository->findCommandesByCompteId($_SESSION['user_id']);

        require __DIR__ . '/../../templates/client/histo_commandes.php';
    }
    

}