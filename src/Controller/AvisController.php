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

    public function createAvis(): void
    {
        // 1. Le client est-il connecté ? Sinon : vers login
        if(!isset($_SESSION ['user_id'] )) {
                header('location:http://localhost:8000/?page=login');
                exit;
            } 
        // 2. Lire note, avis et commandeId dans $_POST
        $avisModal = htmlspecialchars($_POST['avis']);
        $noteModal = ((int)$_POST['note']);
        $commandeIdModal = ((int)$_POST['commandeId']);

        if ((empty($avisModal) || empty($noteModal)) || (($noteModal < 1) || ($noteModal > 5))) {
            $_SESSION['erreurAvis'] = "Votre avis n'a pas été enregistré.";                
            header('location:http://localhost:8000/?page=histo_commandes');
            exit;
        }


        // 3. Vérifier la commande : à lui, Terminée, pas encore d'avis
        $retourCanCommande = $this->avisRepository->canCommandeReceiveAvis($commandeIdModal,$_SESSION ['user_id']);

        if ($retourCanCommande !== true) {
            header('location:http://localhost:8000/?page=histo_commandes');
            exit;
        }
        // 4. Appeler create() du repository
        $this->avisRepository->create($avisModal, $noteModal, $commandeIdModal);

        // 5. Message flash + redirection vers l'historique
        $_SESSION['successAvis'] = "Votre avis a été enregistré.";                
            header('location:http://localhost:8000/?page=histo_commandes');
            exit;
    }

    public function showAvisEmploye(): void {
        //1. Demander au repo les avis en attente de validation
        $avisEnAttente = $this->avisRepository->findAllAvisByStatut('En attente de validation');
        require __DIR__ . '/../../templates/admin/avis_validate.php';

    }

    public function updateStatutAvis(): void {

    // 1. lire les 2 infos reçues dans $_POST (id de l'avis + statut choisi)
    $idAvis = ((int)$_POST['idAvis']);
    $actionValidateRefused = $_POST['actionValidateRefused'];

    // 2. vérifier que le statut est bien 'Validé' ou 'Refusé' (sinon : message d'erreur + redirection)
    if ($actionValidateRefused !== 'Validé' && $actionValidateRefused !== 'Refusé') {
        $_SESSION['erreurStatutAvis'] = "Le statut ne permet pas de validé ou refusé l'avis.";
            header('location:http://localhost:8000/?page=avis_validate');
            exit;
    }
    // 3. appeler le repository pour modifier l'avis
    $this->avisRepository->updateAvis($idAvis, $actionValidateRefused);

    // 4. préparer le message de succès
    $_SESSION['successStatutAvis'] = "Votre validation de l'avis a été enregistrée.";                
            header('location:http://localhost:8000/?page=avis_validate');
            exit;
  
    }
}