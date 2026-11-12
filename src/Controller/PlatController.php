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

//Fonction qui récupère les plats et les affiche dans le template des plats
    public function showPlat(): void
    {
        $plats = $this->platRepository->findAll();
        require __DIR__ . '/../../templates/admin/plats.php';
    }

//Fonction qui récupère le plat demandé dans le formulaire pour traitement dans la fonction create des plats et redirige vers la liste des plats
    public function createPlat(): void
    {
        $namePlat = $_POST['namePlat'];
        $typePlat = $_POST['typePlat'];
        
        $this->platRepository->create($namePlat,  $typePlat);
        header('location:/?page=plats');
        exit;
    }

//Fonction qui affiche le template de création des plats
    public function showPlatCreate(): void 
    {
        require __DIR__ . '/../../templates/admin/plat_create.php';
    }

//Fonction qui récupère l'ID et le type d'élément à supprimer et l'affiche dans le template commun de confirmation de suppression 
    public function showDeleteConfirm(): void {
        $id = ($_POST['id']);
        $entity = ($_POST['entity']);
        require __DIR__ . '/../../templates/partials/delete_confirm.php';
    }

//Fonction qui récupère l'ID du plat à supprimer, le try essaie de supprimer si aucune contrainte détectée sinon renvoie une erreur dans le catch
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
        //Vérification que l'id est bien dans l'adresse sinon retour à la liste des plats
        if(!isset($_GET ['id'] )) {
                header('location:/?page=plats');
                exit;
            } 

        $platModifier = $this->platRepository->findById((int)$_GET['id']);

        //si pas de plat -> retour à la liste des plats
        if($platModifier === null) {
            header('location:/?page=plats');
            exit;
        }
        require __DIR__ . '/../../templates/admin/plat_update.php';

    }

//Fonction qui récupère les infos du plat et permet de mettre à jour la base en appelant le repo sinon message d'erreur et retour à la liste de modification des plats, si ok à la liste de splats 
    public function updatePlat(): void 
    {
        $nomPlat = (string)($_POST['namePlat']);
        $typePlat = (string)($_POST['typePlat']);
        $id = (int)$_POST['id'];

    //Vérification des champs obligatoires non vides sinon erreur + retour
    if(
    $nomPlat === '' 
    || $typePlat === '' 
    || $id <= 0
    ) {
        $_SESSION['erreurUpdatePlat'] = "Les modifications apportées au plat n'ont pas pu être enregistrées.";
            header('location:/?page=plat_update&id=' . $id);
            exit;
    }

    //Maj en base
    $this->platRepository->update($id, $nomPlat, $typePlat);

     $_SESSION['successUpdatePlat'] = "Les modifications ont été enregistrées.";
            header('location:/?page=plats');
            exit;
    }

}