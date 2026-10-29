<?php


session_start();


require_once __DIR__ . '/../vendor/autoload.php';

use Tacha\ViteEtGourmand\Database;
use Tacha\ViteEtGourmand\Controller\AuthController;
use Tacha\ViteEtGourmand\Repository\CompteRepository;
use Tacha\ViteEtGourmand\Controller\MenuController;
use Tacha\ViteEtGourmand\Repository\MenuRepository;
use Tacha\ViteEtGourmand\Controller\PlatController;
use Tacha\ViteEtGourmand\Repository\PlatRepository;
use Tacha\ViteEtGourmand\Controller\AllergeneController;
use Tacha\ViteEtGourmand\Controller\ContactController;
use Tacha\ViteEtGourmand\Repository\AllergeneRepository;
use Tacha\ViteEtGourmand\Service\MailService;
use Tacha\ViteEtGourmand\Repository\CommandeRepository;
use Tacha\ViteEtGourmand\Controller\CommandeController;
use Tacha\ViteEtGourmand\Repository\AvisRepository;
use Tacha\ViteEtGourmand\Controller\AvisController;
use Tacha\ViteEtGourmand\Repository\HoraireRepository;
use Tacha\ViteEtGourmand\Controller\HoraireController;




$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$data = new Database();
$repo = new CompteRepository($data);
$mailService = new MailService();
$controller = new AuthController($repo, $mailService);
$menuRepo = new MenuRepository($data);
$menuController = new MenuController($menuRepo);
$platRepo = new PlatRepository($data);
$platController = new PlatController($platRepo);
$allergeneRepo = new AllergeneRepository($data);
$allergeneController = new AllergeneController($allergeneRepo);
$contactController = new ContactController($mailService);
$commandeRepository = new CommandeRepository($data);
$commandeController = new CommandeController($repo, $menuRepo, $commandeRepository, $mailService);
$avisRepository = new AvisRepository($data);
$avisController = new AvisController($avisRepository);
$horaireRepository = new HoraireRepository($data);
$horaireController = new HoraireController($horaireRepository);





//condition d'ouverture de la page d'accueil si aucune page ou si la page est home
if (!isset($_GET['page']) || $_GET['page'] === 'home') {
    $avisController->showAvisHome();
}

if (isset($_GET['page']) && $_GET['page'] === 'register') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $controller->showRegister();
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller->Register();
    }
}

if (isset($_GET['page']) && $_GET['page'] === 'login') {
   if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $controller->showLogin();
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller->login();
    }
}

if (isset($_GET['page']) && $_GET['page'] === 'logout') {
   $controller->logout();
}

if (isset($_GET['page']) && $_GET['page'] === 'admin') {
    $controller->checkEmploye();
    $controller->showDashBoard();
}

//ADMIN/EMPLOYES

if (isset($_GET['page']) && $_GET['page'] === 'admin_menus') {
    $controller->checkEmploye();
    $menuController->showMenus();
}

if (isset($_GET['page']) && $_GET['page'] === 'employe_create') {
    $controller->checkAdmin();
   if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $controller->showEmployeCreate();
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller->createEmploye();
    }
}

if (isset($_GET['page']) && $_GET['page'] === 'employes') {
    $controller->checkAdmin();
    $controller->showEmploye();
}

if (isset($_GET['page']) && $_GET['page'] === 'toggle_actif') {
    $controller->checkAdmin();
    $controller->toggleActif();
}

// LES HORAIRES 
if (isset($_GET['page']) && $_GET['page'] === 'admin_horaires') {
    $controller->checkEmploye();
    $horaireController->showHoraires();
}

if (isset($_GET['page']) && $_GET['page'] === 'horaire_update') {
    $controller->checkEmploye();
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $horaireController->showHoraireUpdate();
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $horaireController->updateHoraire();
    }
}


// COMMANDES
// Route qui vérifie si le user est connecté et renvoie au formulaire de la commande en GET sinon à la préparation de la commande si POST (vérification, calcul prix)
if (isset($_GET['page']) && $_GET['page'] === 'commande_create') {
    $controller->checkLogin();
   if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $commandeController->showCommandeCreate();
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $commandeController->prepareCommande();
    }
}

// Route qui vérifie si le user est connecté et renvoie au formulaire de validation de la commande en GET sinon enregistre la commande en BDD si POST 
if (isset($_GET['page']) && $_GET['page'] === 'commande_validate') {
    $controller->checkLogin();
   if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $commandeController->showCommandeValidate();
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $commandeController->createCommande();
    }
}


//Route pour afficher la liste des commandes pour l'employé et l'admin et pour modifier le statut
if (isset($_GET['page']) && $_GET['page'] === 'admin_commandes') {
    $controller->checkEmploye();
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $commandeController->showCommandesEmploye();
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $commandeController->updateStatutCommandeEmploye();
    }
}

//Route pour afficher la liste des commandes pour l'employé et l'admin après validation de l'annulation de la commande
if (isset($_GET['page']) && $_GET['page'] === 'annuler_commande') {
    $controller->checkEmploye();
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $commandeController->showCommandesEmploye();
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $commandeController->updateMotifContactCommande();
    }
}

//COMPTE CLIENT
//Route pour accéder au compte client
if (isset($_GET['page']) && $_GET['page'] === 'compte_client') {
    $commandeController->showAllCommandesClient();
}

//Route pour accéder à l'historique des commandes du client
if (isset($_GET['page']) && $_GET['page'] === 'histo_commandes') {
    $commandeController->showAllHistoCommandesClient();
}

//Route pour update des données personnelles
if (isset($_GET['page']) && $_GET['page'] === 'infos_personnelles') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $controller->showInfospersonal();
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller->updateInfosPersonal();
    }
}

//LES AVIS
//Route pour la création de l'avis de la commande
if (isset($_GET['page']) && $_GET['page'] === 'avis') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $avisController->createAvis();
    }
}

//Route de validation de l'avis (employé)
if (isset($_GET['page']) && $_GET['page'] === 'avis_validate') {
    $controller->checkEmploye();
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $avisController->showAvisEmploye();
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $avisController->updateStatutAvis();
    }
}

//MENUS

if (isset($_GET['page']) && $_GET['page'] === 'menus') {
    $menuController->showPublicMenus();
}

//Route pour accéder au détail du menu
if (isset($_GET['page']) && $_GET['page'] === 'menu_details') {
    $menuController->showDetailMenu();
}

if (isset($_GET['page']) && $_GET['page'] === 'menu_create') {
    $controller->checkEmploye();
   if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $menuController->showMenuCreate();
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $menuController->createMenu();
    }
}

if (isset($_GET['page']) && $_GET['page'] === 'menu_update') {
    $controller->checkEmploye();
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $menuController->showMenuUpdate();
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $menuController->updateMenu();
    }
}

if (isset($_GET['page']) && $_GET['page'] === 'menu_delete') {
    $controller->checkEmploye();
    $menuController->deleteMenu();
}



//PLATS

if (isset($_GET['page']) && $_GET['page'] === 'plats') {
    $controller->checkEmploye();
    $platController->showPlat();
}

if (isset($_GET['page']) && $_GET['page'] === 'plat_create') {
    $controller->checkEmploye();
   if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $platController->showPlatCreate();
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $platController->createPlat();
    }
}

if (isset($_GET['page']) && $_GET['page'] === 'plat_delete') {
    $controller->checkEmploye();
    $platController->deletePlat();
}

if (isset($_GET['page']) && $_GET['page'] === 'plat_update') {
    $controller->checkEmploye();
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $platController->showPlatUpdate();
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $platController->updatePlat();
    }
}



//ALLERGENES

if (isset($_GET['page']) && $_GET['page'] === 'allergenes') {
    $controller->checkEmploye();
    $allergeneController->showAllergene();
}

if (isset($_GET['page']) && $_GET['page'] === 'allergene_create') {
    $controller->checkEmploye();
   if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $allergeneController->showAllergeneCreate();
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $allergeneController->createAllergene();
    }
}

if (isset($_GET['page']) && $_GET['page'] === 'allergene_delete') {
    $controller->checkEmploye();
    $allergeneController->deleteAllergene();
}

// CONTACTS
//Route pour accéder à la page des contacts
if (isset($_GET['page']) && $_GET['page'] === 'contact') {
   if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $contactController->showContact();
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $contactController->sendContact();
    }
}

//ROUTE DELETE

if (isset($_GET['page']) && $_GET['page'] === 'delete_confirm') {
    $controller->checkEmploye();
    $menuController->showDeleteConfirm();
}





