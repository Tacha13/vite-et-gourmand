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
        //Rôle utilisateur mis en dur car à l'inscription on ne peut être que 'utilisateur' > cela empêche une modification via l'inspecteur
        $role = 'utilisateur';
        //Array qui garde les infos saisies en mémoire si le mot d epasse est incorrect > permet de ne pas ressaisir les informations
        $_SESSION['saveSaisieRegister'] = [
            'name' => $_POST['name'], 
            'firstname' => $_POST['firstname'], 
            'email' => $_POST['email'], 
            'phone' => $_POST['phone'], 
            'adress' => $_POST['adress'], 
            'adressAptInput' => $_POST['adressAptInput'], 
            'postalCode' => $_POST['postalCode'], 
            'city' => $_POST['city'], 
             ];

        $checkEmail = $this->compteRepository->findByEmail($email);
        if ($checkEmail !== null) {
            $_SESSION['erreurEmailRegister'] = "Veuillez vérifier l'email saisi.";
            header('location:http://localhost:8000/?page=register');
            exit;
        }

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
                $_SESSION['erreurFormPassword'] = "Le mot de passe ne respecte pas le format attendu : Votre mot de passe doit contenir au moins :
                10 caractères, 1 majuscule, 1 minuscule, 1 chiffre, 1 caractère spécial.";
                header('location:http://localhost:8000/?page=register');
                exit;
            }
        } else {
                $_SESSION['erreurDifferentPassword'] = "Le mot de passe ne correspond pas au mot de passe initial saisi, veuillez corriger.";
                header('location:http://localhost:8000/?page=register');
                exit;
        }
        unset($_SESSION['saveSaisieRegister']);

        $_SESSION['successRegister'] = "Votre compte est créé. Vous pouvez vous identifier ci-dessous.";                
        header('location:http://localhost:8000/?page=login');
        exit;
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
            if ($resultMail['actif'] !== 1) {
                $_SESSION['erreurActif'] = "Vous ne pouvez pas vous connecter, votre compte est inactif.";
                header('location:http://localhost:8000/?page=login');
                exit;
            }
            $_SESSION['user_id'] = $resultMail['id'];
            $_SESSION['user_email'] = $resultMail['email'];
            $_SESSION['user_nom'] = $resultMail['nom'];
            $_SESSION['user_prenom'] = $resultMail['prenom'];
            $_SESSION['user_role'] = $resultMail['role'];
            if ($_SESSION['user_role'] === 'admin' || $_SESSION['user_role'] === 'employe') {
                header('location:http://localhost:8000/?page=admin');
                exit;
            } header('location:http://localhost:8000/?page=home');
                exit;
        }else {
            $_SESSION['erreurCompte'] = "L'email ou le mot de passe est incorrect, veuillez réessayer ou nous contacter.";
            header('location:http://localhost:8000/?page=login');
            exit;
        }
    } else {
            $_SESSION['erreurCompte'] = "L'email ou le mot de passe est incorrect, veuillez réessayer ou nous contacter.";
            header('location:http://localhost:8000/?page=login');
            exit;
        }
    }

    public function logout(): void {
        $_SESSION = [];
        session_destroy();
        header('location:http://localhost:8000/?page=login');
        exit;
    }


# Fonction qui redirige vers la page login si le role est non admin ou non connecté 
    public function checkAdmin(): void {
        if((!isset($_SESSION ['user_id'])) || $_SESSION['user_role'] !== 'admin') {
            header('location:http://localhost:8000/?page=login');
            exit;
        }
    }

# Fonction qui redirige vers la page login si le role est non admin/employe ou non connecté 
    public function checkEmploye(): void {
        if((!isset($_SESSION ['user_id'])) || (($_SESSION ['user_role']) !== 'admin') && (($_SESSION ['user_role']) !== 'employe') ) {
            header('location:http://localhost:8000/?page=login');
            exit;
        }
    }

    # Fonction qui redirige vers la page login si l'utilisateur n'est pas encore connecté    
    public function checkLogin(): void {
        if(!isset($_SESSION['user_id'])) {
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
        //Rôle 'employe' mis en dur car à la création par l'admin on ne peut être que 'employe' > cela empêche une modification via l'inspecteur
        $roleEmploye = 'employe';

        $hashedPassword = password_hash($passwordEmploye, PASSWORD_BCRYPT);
        $this->compteRepository->create($emailEmploye, $hashedPassword, $nameEmploye, $prenomEmploye, $telEmploye, $adressEmploye, $complAdressEmploye, $postalEmploye, $communeEmploye, $roleEmploye);
        
        $body = "Bonjour $prenomEmploye $nameEmploye, \n Votre compte Employé a été créé. \n Vous trouverez ci-dessous votre identifiant de connexion : \n Votre identifiant : $emailEmploye \n Votre mot de passe vous sera communiqé par l'administrateur. \n Vite & Gourmand";
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
    
    public function showInfospersonal(): void 
    {
        if(!isset($_SESSION['user_id'])) {
            header('location:http://localhost:8000/?page=login');
            exit;
        } 
        $infoPersonal = $this->compteRepository->findById($_SESSION['user_id']);

        require __DIR__ . '/../../templates/client/infos_personnelles.php';
    }



}


