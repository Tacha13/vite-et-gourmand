<?php

namespace Tacha\ViteEtGourmand\Controller;

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
        header('location:http://localhost:8000/?page=plats');
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
        $this->platRepository->delete($_POST['id']);
        header('location:http://localhost:8000/?page=plats');
        exit;
    }


}