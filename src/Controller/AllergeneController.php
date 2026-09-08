<?php

namespace Tacha\ViteEtGourmand\Controller;

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
        $this->allergeneRepository->delete($_POST['id']);
        header('location:http://localhost:8000/?page=allergenes');
        exit;
    }


}