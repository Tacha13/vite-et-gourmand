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

//Fonction qui récupère la liste des allergènes auprès du repo puis l'affiche dans le template allergenes 
    public function showAllergene(): void
    {
        $allergenes = $this->allergeneRepository->findAll();
        require __DIR__ . '/../../templates/admin/allergenes.php';
    }

//Fonction qui récupère l'allergène demandé dans le formulaire pour traitement dans la fonction create des allergènes et redirige vers la liste des allergènes
    public function createAllergene(): void
    {
        $allergene = $_POST['allergene'];
        
        $this->allergeneRepository->create($allergene);
        header('location:/?page=allergenes');
        exit;
    }

//Fonction qui affiche le template de création des allergènes 
    public function showAllergeneCreate(): void 
    {
        require __DIR__ . '/../../templates/admin/allergene_create.php';
    }

//Fonction qui récupère l'ID et le type d'élément à supprimer et l'affiche dans le template commun de confirmation de suppression 
    public function showDeleteConfirm(): void {
        $id = ($_POST['id']);
        $entity = ($_POST['entity']);//entity permet de savoir s'il s'agit d'un plat, allergène, menu
        require __DIR__ . '/../../templates/partials/delete_confirm.php';
    }

//Fonction qui récupère l'ID de l'allergène à supprimer, le try essaie de supprimer si aucune contrainte détectée sinon renvoie une erreur dans le catch
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
        //Vérification que l'id est bien dans l'adresse sinon retour à la liste des allergenes
        if(!isset($_GET ['id'] )) {
                header('location:/?page=allergenes');
                exit;
            } 

        //Demander au repo les infos de l'allergene selon l'id
        $allergeneModifier = $this->allergeneRepository->findById((int)$_GET['id']);

        //si pas d'allergenes -> retour à la liste des allergenes
        if($allergeneModifier === null) {
            header('location:/?page=allergenes');
            exit;
        }
        
        //Charge le formulaire
        require __DIR__ . '/../../templates/admin/allergene_update.php';

    }

//Fonction qui permet de mettre à jour la base en appelant le repo sinon message d'erreur et retour à la liste de modification des allergenes 
    public function updateAllergene(): void 
    {
    //LIre l'id et les champs du formulaire en POST
        $nomAllergene = (string)($_POST['nomAllergene']);
        $id = (int)$_POST['id'];

    //Vérification des champs obligatoires non vides sinon erreur + retour
    if(
    $nomAllergene === '' 
    || $id <= 0
    ) {
        $_SESSION['erreurUpdateAllergene'] = "Les modifications apportées à l'allergène n'ont pas pu être enregistrées.";
            header('location:/?page=allergene_update&id=' . $id);
            exit;
    }

    //Appeler le repo pour MAJ
    $this->allergeneRepository->update($id, $nomAllergene);

    //Message succes
     $_SESSION['successUpdateAllergene'] = "Les modifications ont été enregistrées.";
            header('location:/?page=allergenes');
            exit;
    }


}