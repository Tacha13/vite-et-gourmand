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

    public function showHoraires(): void
    {
        $horaires = $this->horaireRepository->findAll();
        require __DIR__ . '/../../templates/admin/admin_horaires.php';
    }

    //Fonction qui récupère les infos d'un horaire avec findById et renvoie à la page de modification de l'horaire
    public function showHoraireUpdate(): void 
    {   
        //1. Vérification que l'id est bien dans l'adresse sinon retour à la liste des horaires
        if(!isset($_GET ['id'] )) {
                header('location:/?page=admin_horaires');
                exit;
            } 

        //2. Demander au repo les infos de l'horaire selon l'id
        $horaireModifier = $this->horaireRepository->findById((int)$_GET['id']);

        //3. si pas d'horaire -> retour à la liste des horaires
        if($horaireModifier === null) {
            header('location:/?page=admin_horaires');
            exit;
        }

        //4. Charge le formulaire
        require __DIR__ . '/../../templates/admin/horaire_update.php';

    }

    //Fonction qui permet de mettre à jour la base en appelant le repo sinon message d'erreur et retour à la liste de modification des horaires 

    public function updateHoraire(): void 
  
    { 
    //1. LIre l'id et les champs du formulaire en POST
        $heureDebutHoraire = (string)($_POST['heureDebut']);
        $heureFinHoraire = (string)($_POST['heureFin']);
        $ouvertHoraire = (int)($_POST['open']);
        $id = (int)$_POST['id'];

    //2. Vérification des champs obligatoires non vides sinon erreur + retour
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

    //3. Appeler le repo pour MAJ
    $this->horaireRepository->update($id, $heureDebutHoraire, $heureFinHoraire, $ouvertHoraire);

    //4. Message succes
     $_SESSION['successUpdateHoraire'] = "Les modifications ont été enregistrées.";
            header('location:/?page=admin_horaires');
            exit;
    }

}