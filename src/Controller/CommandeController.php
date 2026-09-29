<?php

namespace Tacha\ViteEtGourmand\Controller;


use Tacha\ViteEtGourmand\Repository\CompteRepository;
use Tacha\ViteEtGourmand\Repository\MenuRepository;

class CommandeController 
{
    
    private CompteRepository $compteRepository;
    private MenuRepository $menuRepository;

    
    public function __construct(CompteRepository $compteRepository, MenuRepository $menuRepository)
    {
        $this->compteRepository = $compteRepository;
        $this->menuRepository = $menuRepository;
    }

    //Route qui récupère les infos d'un client et du menu avec findById et renvoie à la page de commande   
    public function showCommandeCreate(): void 
    {
        if (isset($_GET['id'])) {
            $idMenu = $this->menuRepository->findById((int)$_GET['id']);
            $idClient = $this->compteRepository->findById($_SESSION['user_id']);
            require __DIR__ . '/../../templates/client/commande_create.php';
        } else {
            header('location:http://localhost:8000/?page=menus');
            exit;
        }
        
    }


}