<?php


namespace Tacha\ViteEtGourmand\Controller;

use Tacha\ViteEtGourmand\Repository\StatistiqueRepository;

class StatistiqueController 
{
    private StatistiqueRepository $statistiqueRepository;

    public function __construct(StatistiqueRepository $statistiqueRepository)
    {
        $this->statistiqueRepository = $statistiqueRepository;
    }

    public function showStatCommande(): void
    {
        $statMenus = $this->statistiqueRepository->findStatParMenu();
        require __DIR__ . '/../../templates/admin/admin_statistiques.php';
    }

}