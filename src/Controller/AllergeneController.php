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
        header('location:http://localhost:8000/?page=allergenes');
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
            header('location:http://localhost:8000/?page=allergenes');
        exit;
        } catch (PDOException $e) { 
            $_SESSION['erreurDeleteAllergene'] = "L'allergène ne peut être supprimé, il est pris en compte dans un ou plusieurs plats.";
            header('location:http://localhost:8000/?page=allergenes');
            exit;
    }
    }


}