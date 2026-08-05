<?php


require_once __DIR__ . '/../vendor/autoload.php';

use Tacha\ViteEtGourmand\Database;
use Tacha\ViteEtGourmand\Controller\AuthController;
use Tacha\ViteEtGourmand\Repository\CompteRepository;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$data = new Database();
$repo = new CompteRepository($data);
$controller = new AuthController($repo);



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->register();
}else {
    $controller->showRegister();
}