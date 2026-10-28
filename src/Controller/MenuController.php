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

 //Route qui récupère les finfos des menus avec findAll et renvoie à la page menus admin   
    public function showMenus(): void
    {
        $menus = $this->menuRepository->findAll();
        require __DIR__ . '/../../templates/admin/admin_menus.php';
    }
 
    //Route qui récupère les infos des menus avec findAll et renvoie à la page menus public   
    public function showPublicMenus(): void 
    {
        $menus = $this->menuRepository->findAll();
        require __DIR__ . '/../../templates/menus.php';
    }

    public function createMenu(): void
    {
        $nameMenu = htmlspecialchars($_POST['nameMenu']);
        $description = htmlspecialchars($_POST['description']);
        $theme = htmlspecialchars($_POST['theme']);
        $persMin = (int)($_POST['persMin']);
        $price = (float)($_POST['price']);
        $conditions = htmlspecialchars($_POST['conditions']);
        $regime = htmlspecialchars($_POST['regime']);
        $stock = (int)($_POST['stock']);
        $image = htmlspecialchars($_POST['image']);

        $this->menuRepository->create($nameMenu,  $description,  $theme,  $persMin,  $price,  $conditions,  $regime,  $stock, $image);
        header('location:http://localhost:8000/?page=admin_menus');
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
        try {
            $this->menuRepository->delete($_POST['id']);
            $_SESSION['successDeleteMenu'] = "Le menu a été correctement supprimé.";
            header('location:http://localhost:8000/?page=admin_menus');
        exit;
        } catch (PDOException $e) { 
            $_SESSION['erreurDeleteMenu'] = "Le menu ne peut être supprimé, il est pris en compte dans une ou plusieurs commandes.";
            header('location:http://localhost:8000/?page=admin_menus');
            exit;
    }
    }

    //Route qui récupère les infos d'un menu avec findById et renvoie à la page menus détail   
    public function showDetailMenu(): void 
    {
        if (isset($_GET['id'])) {
            $idMenu = $this->menuRepository->findById((int)$_GET['id']);
            require __DIR__ . '/../../templates/menu_details.php';
        } else {
            header('location:http://localhost:8000/?page=menus');
            exit;
        }
        
    }

    //Fonction qui récupère les infos d'un menu avec findById et renvoie à la page de modification du menu
    public function showMenuUpdate(): void 
    {   
        //1. Vérification que l'id est bien dans l'adresse sinon retour à la liste des menus
        if(!isset($_GET ['id'] )) {
                header('location:http://localhost:8000/?page=admin_menus');
                exit;
            } 

        //2. Demander au repo les infos du menu selon l'id
        $menuModifier = $this->menuRepository->findById((int)$_GET['id']);

        //3. si pas de menu -> retour à la liste de smenus
        if($menuModifier === null) {
            header('location:http://localhost:8000/?page=admin_menus');
            exit;
        }

        //4. Charge le formulaire
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

    //2. Vérification des champs obligatoires non vides sinon erreur + retour
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
            header('location:http://localhost:8000/?page=menu_update&id=' . $id);
            exit;
    }

    //3. Appeler le repo pour MAJ
    $this->menuRepository->update($id, $nomMenu, $description, $theme, $nbPersonneMin, $prix, $conditions, $regime, $stock, $image);

    //4. Message succes
     $_SESSION['successUpdateMenu'] = "Les modifications ont été enregistrées.";
            header('location:http://localhost:8000/?page=admin_menus');
            exit;
    }


}