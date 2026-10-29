<?php

namespace Tacha\ViteEtGourmand\Controller;

use PDOException;
use Tacha\ViteEtGourmand\Repository\PlatRepository;

class PlatController
{
    private PlatRepository $platRepository;

    public function __construct(PlatRepository $platRepository)
    {
        $this->platRepository = $platRepository;
    }

    public function showPlat(): void
    {
        $plats = $this->platRepository->findAll();
        require __DIR__ . '/../../templates/admin/plats.php';
    }

    public function createPlat(): void
    {
        $namePlat = htmlspecialchars($_POST['namePlat']);
        $typePlat = htmlspecialchars($_POST['typePlat']);
        
        $this->platRepository->create($namePlat,  $typePlat);
        header('location:/?page=plats');
        exit;
    }

    public function showPlatCreate(): void 
    {
        require __DIR__ . '/../../templates/admin/plat_create.php';
    }

    public function showDeleteConfirm(): void {
        $id = ($_POST['id']);
        $entity = ($_POST['entity']);
        require __DIR__ . '/../../templates/partials/delete_confirm.php';
    }

    public function deletePlat(): void
    {
         try {
            $this->platRepository->delete($_POST['id']);
            $_SESSION['successDeletePlat'] = "Le plat a été correctement supprimé.";
            header('location:/?page=plats');
        exit;
        } catch (PDOException $e) { 
            $_SESSION['erreurDeletePlat'] = "Le plat ne peut être supprimé, il est pris en compte dans un ou plusieurs menus et/ou allergènes.";
            header('location:/?page=plats');
            exit;
    }
    }

    //Fonction qui récupère les infos d'un plat avec findById et renvoie à la page de modification du plat
    public function showPlatUpdate(): void 
    {   
        //1. Vérification que l'id est bien dans l'adresse sinon retour à la liste des plats
        if(!isset($_GET ['id'] )) {
                header('location:/?page=plats');
                exit;
            } 

        //2. Demander au repo les infos du plat selon l'id
        $platModifier = $this->platRepository->findById((int)$_GET['id']);

        //3. si pas de plat -> retour à la liste des plats
        if($platModifier === null) {
            header('location:/?page=plats');
            exit;
        }

        //4. Charge le formulaire
        require __DIR__ . '/../../templates/admin/plat_update.php';

    }

    //Fonction qui permet de mettre à jour la base en appelant le repo sinon message d'erreur et retour à la liste de modification des plats 
    public function updatePlat(): void 
    {
    //1. LIre l'id et les champs du formulaire en POST
        $nomPlat = (string)($_POST['namePlat']);
        $typePlat = (string)($_POST['typePlat']);
        $id = (int)$_POST['id'];

    //2. Vérification des champs obligatoires non vides sinon erreur + retour
    if(
    $nomPlat === '' 
    || $typePlat === '' 
    || $id <= 0
    ) {
        $_SESSION['erreurUpdatePlat'] = "Les modifications apportées au plat n'ont pas pu être enregistrées.";
            header('location:/?page=plat_update&id=' . $id);
            exit;
    }

    //3. Appeler le repo pour MAJ
    $this->platRepository->update($id, $nomPlat, $typePlat);

    //4. Message succes
     $_SESSION['successUpdatePlat'] = "Les modifications ont été enregistrées.";
            header('location:/?page=plats');
            exit;
    }

}