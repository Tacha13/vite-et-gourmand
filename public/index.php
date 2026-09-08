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



$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$data = new Database();
$repo = new CompteRepository($data);
$controller = new AuthController($repo);
$menuRepo = new MenuRepository($data);
$menuController = new MenuController($menuRepo);
$platRepo = new PlatRepository($data);
$platController = new PlatController($platRepo);



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
    $controller->checkAdmin();
    $controller->showDashBoard();
}

if (isset($_GET['page']) && $_GET['page'] === 'menus') {
    $menuController->showMenus();
}

if (isset($_GET['page']) && $_GET['page'] === 'menu_create') {
   if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $menuController->showMenuCreate();
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $menuController->createMenu();
    }
}

if (isset($_GET['page']) && $_GET['page'] === 'delete_confirm') {
    $menuController->showDeleteConfirm();
}

if (isset($_GET['page']) && $_GET['page'] === 'menu_delete') {
    $menuController->deleteMenu();
}


if (isset($_GET['page']) && $_GET['page'] === 'plats') {
    $platController->showPlat();
}

if (isset($_GET['page']) && $_GET['page'] === 'plat_create') {
   if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $platController->showPlatCreate();
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $platController->createPlat();
    }
}

if (isset($_GET['page']) && $_GET['page'] === 'plat_delete') {
    $platController->deletePlat();
}

