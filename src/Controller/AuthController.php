<?php

namespace Tacha\ViteEtGourmand\Controller;

use Tacha\ViteEtGourmand\Repository\CompteRepository;

class AuthController
{
    private CompteRepository $compteRepository;

    public function __construct(CompteRepository $compteRepository)
    {
        $this->compteRepository = $compteRepository;
    }


    public function showRegister(): void
    {
        require __DIR__ . '/../../templates/auth/register.php';
    }

    public function register(): void
    {
        $name = htmlspecialchars($_POST['name']);
        $firstname = htmlspecialchars($_POST['firstname']);
        $email = htmlspecialchars($_POST['email']);
        $phone = htmlspecialchars($_POST['phone']);
        $adress = htmlspecialchars($_POST['adress']);
        $adressAptInput = htmlspecialchars($_POST['adressAptInput']);
        $postalCode = htmlspecialchars($_POST['postalCode']);
        $city = htmlspecialchars($_POST['city']);
        $password = $_POST['password'];
        $passwordConfirm = $_POST['passwordConfirm'];

        if ($password === $passwordConfirm) {
            if (
                preg_match('/[A-Z]/', $password)
                && preg_match('/[a-z]/', $password)
                && preg_match('/[0-9]/', $password)
                && preg_match('/[^a-zA-Z0-9]/', $password)
                && strlen($password) >= 10
            ) {
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                $this->compteRepository->create($email, $hashedPassword, $name, $firstname, $phone, $adress, $adressAptInput, $postalCode, $city);
            } else {
                echo "Format invalide";
            }
        } else {
            echo "mot de passe différent";
        }
    }

    public function showLogin(): void {
        require __DIR__ . '/../../templates/auth/login.php';
    }

    public function login(): void
    {
        $email = htmlspecialchars($_POST['email']);
        $password = $_POST['password'];
        $resultMail = $this->compteRepository->findByEmail($email);

        if ($resultMail !== null) {
        if (password_verify($password, $resultMail['mot_de_passe_hash'])) {
            $_SESSION['user_id'] = $resultMail['id'];
            $_SESSION['user_email'] = $resultMail['email'];
            $_SESSION['user_role'] = $resultMail['role'];
            header('location:http://localhost:8000/?page=login');
            exit;
        }else {
            echo "mauvais mot de passe";
        }
    } else {
        echo "l'email n'existe pas";
        }
    }

    public function logout(): void {
        $_SESSION = [];
        session_destroy();
        header('location:http://localhost:8000/?page=login');
        exit;
    }

}


