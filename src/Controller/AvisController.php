<?php

namespace Tacha\ViteEtGourmand\Controller;

use PDOException;
use Tacha\ViteEtGourmand\Repository\AvisRepository;

class AvisController {

    private AvisRepository $avisRepository;

    public function __construct(AvisRepository $avisRepository)
    {
        $this->avisRepository = $avisRepository;
    }

//Fonction qui vérifie si l'utilisateur est connecté et crée l'avis du client
    public function createAvis(): void
    {
        
        if(!isset($_SESSION ['user_id'] )) {
                header('location:/?page=login');
                exit;
            } 
        //Lire note, avis et commandeId dans $_POST
        $avisModal = $_POST['avis'];
        $noteModal = ((int)$_POST['note']);
        $commandeIdModal = ((int)$_POST['commandeId']);

        if ((empty($avisModal) || empty($noteModal)) || (($noteModal < 1) || ($noteModal > 5))) {
            $_SESSION['erreurAvis'] = "Votre avis n'a pas été enregistré.";                
            header('location:/?page=histo_commandes');
            exit;
        }


        //Vérification de la commande, si elle terminée et pas encore d'avis, dans ce cas on crée l'avis avec message de succés
        $retourCanCommande = $this->avisRepository->canCommandeReceiveAvis($commandeIdModal,$_SESSION ['user_id']);

        if ($retourCanCommande !== true) {
            header('location:/?page=histo_commandes');
            exit;
        }
        $this->avisRepository->create($avisModal, $noteModal, $commandeIdModal);

        $_SESSION['successAvis'] = "Votre avis a été enregistré.";                
            header('location:/?page=histo_commandes');
            exit;
    }

//Fonction qui affiche les avis en attente de validation dans avis de l'espace employé
    public function showAvisEmploye(): void {
        $avisEnAttente = $this->avisRepository->findAllAvisByStatut('En attente de validation');
        require __DIR__ . '/../../templates/admin/avis_validate.php';

    }

//Fonction qui récupère l'avis reçues l'action de validation ou non de l'employé en POST et met à jour la base + messages
    public function updateStatutAvis(): void {

    $idAvis = ((int)$_POST['idAvis']);
    $actionValidateRefused = $_POST['actionValidateRefused'];

    if ($actionValidateRefused !== 'Validé' && $actionValidateRefused !== 'Refusé') {
        $_SESSION['erreurStatutAvis'] = "Le statut ne permet pas de validé ou refusé l'avis.";
            header('location:/?page=avis_validate');
            exit;
    }
    $this->avisRepository->updateAvis($idAvis, $actionValidateRefused);

    $_SESSION['successStatutAvis'] = "Votre validation de l'avis a été enregistrée.";                
            header('location:/?page=avis_validate');
            exit;
  
    }

//Fonction qui récupère les avis validés pour affichage sur la page d'accueil
    public function showAvisHome(): void {
         //1. Demander au repo les avis validés pour affichage page home
        $avisValide = $this->avisRepository->findAllAvisByStatut('Validé');
        require __DIR__ . '/../../templates/home.php';
    }
}