<?php

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

use Tacha\ViteEtGourmand\Database;
use Tacha\ViteEtGourmand\Controller\AuthController;
use Tacha\ViteEtGourmand\Repository\CompteRepository;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$data = new Database();
$repo = new CompteRepository($data);
$controller = new AuthController($repo);



if ($_GET['page'] === 'register') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $controller->showRegister();
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller->Register();
    }
}

if ($_GET ['page'] === 'login') {
   if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $controller->showLogin();
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller->login();
    }
}

if ($_GET ['page'] === 'logout') {
   $controller->logout();
}

if ($_GET ['page'] === 'admin') {
    $controller->checkAdmin();
    $controller->showDashBoard();
}