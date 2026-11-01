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
        $menu = $_GET['menu'] ?? null;
        $dateDebut = $_GET['dateDebut'] ?? null;
        $dateFin = $_GET['dateFin'] ?? null;
        
        $statMenus = $this->statistiqueRepository->findStatParMenu($menu, $dateDebut, $dateFin);


        require __DIR__ . '/../../templates/admin/admin_statistiques.php';
    }

}