<?php

namespace Tacha\ViteEtGourmand\Controller;

use Tacha\ViteEtGourmand\Repository\CompteRepository;
use Tacha\ViteEtGourmand\Service\MailService;

class AuthController
{
    private CompteRepository $compteRepository;
    private MailService $mailService;


    public function __construct(CompteRepository $compteRepository, MailService $mailService)
    {
        $this->compteRepository = $compteRepository;
        $this->mailService = $mailService;
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
        $role = $_POST['role'];

        if ($password === $passwordConfirm) {
            if (
                preg_match('/[A-Z]/', $password)
                && preg_match('/[a-z]/', $password)
                && preg_match('/[0-9]/', $password)
                && preg_match('/[^a-zA-Z0-9]/', $password)
                && strlen($password) >= 10
            ) {
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                $this->compteRepository->create($email, $hashedPassword, $name, $firstname, $phone, $adress, $adressAptInput, $postalCode, $city, $role);
                
                $body = "Bonjour $firstname, Merci d'avoir créé votre compte chez Vite & Gourmand ! Nous sommes ravis de vous accompagner dans la préparation de vos futurs événements. Des pièces cocktails raffinées aux buffets conviviaux, notre équipe met tout son savoir-faire en cuisine pour régaler vos convives et faire de vos moments de partage une réussite. Vous pouvez dès à présent composer votre menu et estimer votre budget en ligne.[Découvrir notre carte et nos formules] À très bientôt, L'équipe de Vite & Gourmand";
                $this->mailService->sendMail($email, "Bienvenue chez Vite et Gourmand", $body);
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
            header('location:http://localhost:8000/?page=admin');
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


# Fonction qui redirige vers la page login si le role est non admin    
    public function checkAdmin(): void {
        if($_SESSION['user_role'] !== 'admin') {
            header('location:http://localhost:8000/?page=login');
            exit;
        }
    }



    public function showDashBoard(): void {
    require __DIR__ . '/../../templates/admin/dashboard.php';
    }

    public function showEmployeCreate(): void
    {
        require __DIR__ . '/../../templates/admin/employe_create.php';
    }

    public function createEmploye () {
        $nameEmploye = htmlspecialchars($_POST['nameEmploye']);
        $prenomEmploye = htmlspecialchars($_POST['prenomEmploye']);
        $adressEmploye = htmlspecialchars($_POST['adressEmploye']);
        $complAdressEmploye = htmlspecialchars($_POST['complAdressEmploye']);
        $postalEmploye = htmlspecialchars($_POST['postalEmploye']);
        $communeEmploye = htmlspecialchars($_POST['communeEmploye']);
        $emailEmploye = htmlspecialchars($_POST['emailEmploye']);
        $telEmploye = htmlspecialchars($_POST['telEmploye']);
        $passwordEmploye = $_POST['passwordEmploye'];
        $roleEmploye = $_POST['roleEmploye'];

        $hashedPassword = password_hash($passwordEmploye, PASSWORD_BCRYPT);
        $this->compteRepository->create($emailEmploye, $hashedPassword, $nameEmploye, $prenomEmploye, $telEmploye, $adressEmploye, $complAdressEmploye, $postalEmploye, $communeEmploye, $roleEmploye);
        
        $body = "Bonjour $prenomEmploye $nameEmploye, Votre compte Employé a été créé, Vous trouverez ci-dessous votre identifiant de connexion";
        $this->mailService->sendMail($emailEmploye, "Bienvenue chez Vite et Gourmand - Création de compte", $body);

        header('location:http://localhost:8000/?page=admin');
        exit;
    }

    public function showEmploye(): void {
        $employes = $this->compteRepository->findAllEmploye();
        require __DIR__ . '/../../templates/admin/employes.php';
    }

    public function toggleActif(): void
    {
        $this->compteRepository->toggleActif($_POST['id']);
        header('location:http://localhost:8000/?page=employes');
        exit;
    }



}


