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

//Fonction qui récupère les filtres choisis et affiche le statistiques correspondantes dans le template des statistiques. Le try lit les données dans MongoDB, si erreur le catch renvoie des tableaux vides et un message
    public function showStatCommande(): void
    {
        $menu = $_GET['menu'] ?? null;
        $dateDebut = $_GET['dateDebut'] ?? null;
        $dateFin = $_GET['dateFin'] ?? null;

        try {
            $statMenus = $this->statistiqueRepository->findStatParMenu($menu, $dateDebut, $dateFin);
            $menusFiltre = $this->statistiqueRepository->findNomMenu();
        } catch (\Exception $e) {
            $_SESSION['erreurStats'] = "Les statistiques sont momentanément indisponibles.";
            $statMenus=[];
            $menusFiltre=[];
        }
        require __DIR__ . '/../../templates/admin/admin_statistiques.php';
    }

}

