<?php


namespace Tacha\ViteEtGourmand\Controller;

use Tacha\ViteEtGourmand\Repository\HoraireRepository;

class HoraireController 
{
    private HoraireRepository $horaireRepository;

    public function __construct(HoraireRepository $horaireRepository)
    {
        $this->horaireRepository = $horaireRepository;
    }

//Fonction qui récupère les horaires et affiche le template de gestion des horaires
    public function showHoraires(): void
    {
        $horaires = $this->horaireRepository->findAll();
        require __DIR__ . '/../../templates/admin/admin_horaires.php';
    }

//Fonction qui récupère les infos d'un horaire avec findById et renvoie à la page de modification de l'horaire
    public function showHoraireUpdate(): void 
    {   
        //Vérification que l'id est bien dans l'adresse sinon retour à la liste des horaires
        if(!isset($_GET ['id'] )) {
                header('location:/?page=admin_horaires');
                exit;
            } 
        //Récupération de l'horaire en base
        $horaireModifier = $this->horaireRepository->findById((int)$_GET['id']);

        if($horaireModifier === null) {
            header('location:/?page=admin_horaires');
            exit;
        }
        require __DIR__ . '/../../templates/admin/horaire_update.php';

    }

//Fonction qui permet de mettre à jour la base en appelant le repo sinon message d'erreur et retour à la modification de l'horaire, si ok retour à la liste des horaires
    public function updateHoraire(): void 
  
    { 
    //Récupération l'id et des champs du formulaire en POST
        $heureDebutHoraire = (string)($_POST['heureDebut']);
        $heureFinHoraire = (string)($_POST['heureFin']);
        $ouvertHoraire = (int)($_POST['open']);
        $id = (int)$_POST['id'];

    //Vérification des champs obligatoires non vides sinon erreur + retour
    if(
    ($ouvertHoraire === 1 && ($heureDebutHoraire === '' || $heureFinHoraire === ''))
    || $id <= 0
    ) {
        $_SESSION['erreurUpdateHoraire'] = "Les modifications apportées à l'horaire n'ont pas pu être enregistrées.";
            header('location:/?page=horaire_update&id=' . $id);
            exit;
    }
    if($ouvertHoraire === 0)
        {
            $heureDebutHoraire = null;
            $heureFinHoraire = null;
        }

    //MAJ en base
    $this->horaireRepository->update($id, $heureDebutHoraire, $heureFinHoraire, $ouvertHoraire);

     $_SESSION['successUpdateHoraire'] = "Les modifications ont été enregistrées.";
            header('location:/?page=admin_horaires');
            exit;
    }

}