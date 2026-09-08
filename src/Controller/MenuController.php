<?php

namespace Tacha\ViteEtGourmand\Controller;

use Tacha\ViteEtGourmand\Repository\MenuRepository;

class MenuController
{
    private MenuRepository $menuRepository;

    public function __construct(MenuRepository $menuRepository)
    {
        $this->menuRepository = $menuRepository;
    }

    public function showMenus(): void
    {
        $menus = $this->menuRepository->findAll();
        require __DIR__ . '/../../templates/admin/menus.php';
    }

    public function createMenu(): void
    {
        $nameMenu = htmlspecialchars($_POST['nameMenu']);
        $description = htmlspecialchars($_POST['description']);
        $theme = htmlspecialchars($_POST['theme']);
        $persMin = (int)($_POST['persMin']);
        $price = (int)($_POST['price']);
        $conditions = htmlspecialchars($_POST['conditions']);
        $regime = htmlspecialchars($_POST['regime']);
        $stock = (int)($_POST['stock']);

        $this->menuRepository->create($nameMenu,  $description,  $theme,  $persMin,  $price,  $conditions,  $regime,  $stock);
        header('location:http://localhost:8000/?page=menus');
        exit;
    }

    public function showMenuCreate(): void 
    {
        require __DIR__ . '/../../templates/admin/menu_create.php';
    }

    public function showDeleteConfirm(): void {
        $id = ($_POST['id']);
        $entity = ($_POST['entity']);
        require __DIR__ . '/../../templates/partials/delete_confirm.php';
    }

    public function deleteMenu(): void
    {
        $this->menuRepository->delete($_POST['id']);
        header('location:http://localhost:8000/?page=menus');
        exit;
    }


}