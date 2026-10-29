<?php

namespace Tacha\ViteEtGourmand\Controller;

use PDOException;
use Tacha\ViteEtGourmand\Repository\AllergeneRepository;

class AllergeneController
{
    private AllergeneRepository $allergeneRepository;

    public function __construct(AllergeneRepository $allergeneRepository)
    {
        $this->allergeneRepository = $allergeneRepository;
    }

    public function showAllergene(): void
    {
        $allergenes = $this->allergeneRepository->findAll();
        require __DIR__ . '/../../templates/admin/allergenes.php';
    }

    public function createAllergene(): void
    {
        $allergene = htmlspecialchars($_POST['allergene']);
        
        $this->allergeneRepository->create($allergene);
        header('location:/?page=allergenes');
        exit;
    }

    public function showAllergeneCreate(): void 
    {
        require __DIR__ . '/../../templates/admin/allergene_create.php';
    }

    public function showDeleteConfirm(): void {
        $id = ($_POST['id']);
        $entity = ($_POST['entity']);
        require __DIR__ . '/../../templates/partials/delete_confirm.php';
    }

    public function deleteAllergene(): void
    {
        try {
            $this->allergeneRepository->delete($_POST['id']);
            $_SESSION['successDeleteAllergene'] = "L'allergène a été correctement supprimé.";
            header('location:/?page=allergenes');
        exit;
        } catch (PDOException $e) { 
            $_SESSION['erreurDeleteAllergene'] = "L'allergène ne peut être supprimé, il est pris en compte dans un ou plusieurs plats.";
            header('location:/?page=allergenes');
            exit;
    }
    }

    //Fonction qui récupère les infos d'un allergene avec findById et renvoie à la page de modification de l'allergene
    public function showAllergeneUpdate(): void 
    {   
        //1. Vérification que l'id est bien dans l'adresse sinon retour à la liste des allergenes
        if(!isset($_GET ['id'] )) {
                header('location:/?page=allergenes');
                exit;
            } 

        //2. Demander au repo les infos de l'allergene selon l'id
        $allergeneModifier = $this->allergeneRepository->findById((int)$_GET['id']);

        //3. si pas d'allergenes -> retour à la liste des allergenes
        if($allergeneModifier === null) {
            header('location:/?page=allergenes');
            exit;
        }
        
        //4. Charge le formulaire
        require __DIR__ . '/../../templates/admin/allergene_update.php';

    }

    //Fonction qui permet de mettre à jour la base en appelant le repo sinon message d'erreur et retour à la liste de modification des allergenes 
    public function updateAllergene(): void 
    {
    //1. LIre l'id et les champs du formulaire en POST
        $nomAllergene = (string)($_POST['nomAllergene']);
        $id = (int)$_POST['id'];

    //2. Vérification des champs obligatoires non vides sinon erreur + retour
    if(
    $nomAllergene === '' 
    || $id <= 0
    ) {
        $_SESSION['erreurUpdateAllergene'] = "Les modifications apportées à l'allergène n'ont pas pu être enregistrées.";
            header('location:/?page=allergene_update&id=' . $id);
            exit;
    }

    //3. Appeler le repo pour MAJ
    $this->allergeneRepository->update($id, $nomAllergene);

    //4. Message succes
     $_SESSION['successUpdateAllergene'] = "Les modifications ont été enregistrées.";
            header('location:/?page=allergenes');
            exit;
    }


}