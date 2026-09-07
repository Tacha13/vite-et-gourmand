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

}