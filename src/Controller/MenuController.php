<?php


namespace Tacha\ViteEtGourmand\Controller;

use PDOException;
use Tacha\ViteEtGourmand\Repository\MenuRepository;

class MenuController
{
    private MenuRepository $menuRepository;

    public function __construct(MenuRepository $menuRepository)
    {
        $this->menuRepository = $menuRepository;
    }

//Fonction qui récupère les infos des menus avec findAll et renvoie à la page menus admin   
    public function showMenus(): void
    {
        $menus = $this->menuRepository->findAll();
        require __DIR__ . '/../../templates/admin/admin_menus.php';
    }
 
//Fonction qui récupère les infos des menus avec findAll et les affiche dans la page menus public   
    public function showPublicMenus(): void 
    {
        $menus = $this->menuRepository->findAll();
        require __DIR__ . '/../../templates/menus.php';
    }

//Fonction qui récupère les infos saisies dans le formulaire de création du menu en POST avec create et renvoie à la page de gestion des menus
    public function createMenu(): void
    {
        $nameMenu = $_POST['nameMenu'];
        $description = $_POST['description'];
        $theme = $_POST['theme'];
        $persMin = (int)($_POST['persMin']);
        $price = (float)($_POST['price']);
        $conditions = $_POST['conditions'];
        $regime = $_POST['regime'];
        $stock = (int)($_POST['stock']);
        $image = $_POST['image'];

        $this->menuRepository->create($nameMenu,  $description,  $theme,  $persMin,  $price,  $conditions,  $regime,  $stock, $image);
        header('location:/?page=admin_menus');
        exit;
    }

//Fonction qui renvoie à la page de création de menu   
    public function showMenuCreate(): void 
    {
        require __DIR__ . '/../../templates/admin/menu_create.php';
    }

//Fonction qui récupère l'ID et le type d'élément à supprimer et l'affiche dans le template commun de confirmation de suppression 
    public function showDeleteConfirm(): void {
        $id = ($_POST['id']);
        $entity = ($_POST['entity']);
        require __DIR__ . '/../../templates/partials/delete_confirm.php';
    }

//Fonction qui récupère l'ID du menu à supprimer, le try essaie de supprimer si aucune contrainte détectée sinon renvoie une erreur dans le catch
    public function deleteMenu(): void
    {
        try {
            $this->menuRepository->delete($_POST['id']);
            $_SESSION['successDeleteMenu'] = "Le menu a été correctement supprimé.";
            header('location:/?page=admin_menus');
        exit;
        } catch (PDOException $e) { 
            $_SESSION['erreurDeleteMenu'] = "Le menu ne peut être supprimé, il est pris en compte dans une ou plusieurs commandes.";
            header('location:/?page=admin_menus');
            exit;
    }
    }

//Fonction qui récupère les infos d'un menu avec findById et celui des plats avec findAllPlatsByIdMenu et renvoie à la page menus détail   
    public function showDetailMenu(): void 
    {
        if (isset($_GET['id'])) {
            $idMenu = $this->menuRepository->findById((int)$_GET['id']);
            $plats = $this->menuRepository->findAllPlatsByIdMenu((int)$_GET['id']);
            require __DIR__ . '/../../templates/menu_details.php';

        } else {
            header('location:/?page=menus');
            exit;
        }
        
    }

//Fonction qui récupère les infos d'un menu avec findById et renvoie à la page de modification du menu si erreur sinon sur la liste des menus
    public function showMenuUpdate(): void 
    {   
        //Vérification que l'id est bien dans l'adresse sinon retour à la liste des menus
        if(!isset($_GET ['id'] )) {
                header('location:/?page=admin_menus');
                exit;
            } 

        //récupération des infos du menu selon l'id
        $menuModifier = $this->menuRepository->findById((int)$_GET['id']);

        //si pas de menu -> retour à la liste des menus
        if($menuModifier === null) {
            header('location:/?page=admin_menus');
            exit;
        }
        require __DIR__ . '/../../templates/admin/menu_update.php';

    }

//Fonction qui permet de mettre à jour la base en appelant le repo sinon message d'erreur et retour à la liste de modification des menus 
    public function updateMenu(): void 
    {
    //1. LIre l'id et les champs du formulaire en POST
        $nomMenu = (string)($_POST['nameMenu']);
        $description = (string)($_POST['description']);
        $theme = (string)($_POST['theme']);
        $nbPersonneMin = (int)$_POST['persMin'];
        $prix = (float)$_POST['price'];
        $conditions = (string)($_POST['conditions']);
        $regime = (string)($_POST['regime']);
        $stock = (int)$_POST['stock'];
        $image = (string)($_POST['image']);
        $id = (int)$_POST['id'];

    //Vérification des champs obligatoires non vides sinon erreur + retour
    if(
    $nomMenu === '' 
    || $description === '' 
    || $theme === '' 
    || $nbPersonneMin <= 0 
    || $prix <= 0 
    || $conditions === '' 
    || $regime === '' 
    || $stock < 0 
    || $image === '' 
    || $id <= 0
    ) {
        $_SESSION['erreurUpdateMenu'] = "Les modifications apportées au menu n'ont pas pu être enregistrées.";
            header('location:/?page=menu_update&id=' . $id);
            exit;
    }

    //MAJ en base
    $this->menuRepository->update($id, $nomMenu, $description, $theme, $nbPersonneMin, $prix, $conditions, $regime, $stock, $image);

     $_SESSION['successUpdateMenu'] = "Les modifications ont été enregistrées.";
            header('location:/?page=admin_menus');
            exit;
    }

//Fonction qui récupère les infos de filtres demandées par le client, on vérifie si c'est null ou vide (on renvoie null) sinon on conserve l'info du filtre et on alimente les paramètres de findMenusFiltres
    public function showFiltresMenus(): void
    {
        $theme = $_GET['theme'] ?? null;
        $regime = $_GET['regime'] ?? null;
        $persNb = $_GET['persNb'] ?? null;
        $priceMin = $_GET['priceMin'] ?? null;
        $priceMax = $_GET['priceMax'] ?? null;

        $persNb = ($persNb === null || $persNb ==='') ? null : (int)$persNb;
        $priceMin = ($priceMin === null || $priceMin ==='') ? null : (float)$priceMin;
        $priceMax = ($priceMax === null || $priceMax ==='') ? null : (float)$priceMax;
        
        $filtresMenus = $this->menuRepository->findMenusFiltres($theme, $regime, $persNb, $priceMin, $priceMax);

        //envoi du résultat en JSON au JavaScript
        header('Content-Type: application/json');
        echo json_encode($filtresMenus);
    }



}