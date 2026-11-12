<?php

namespace Tacha\ViteEtGourmand\Controller;

use Tacha\ViteEtGourmand\Repository\CompteRepository;
use Tacha\ViteEtGourmand\Repository\TokenRepository;
use Tacha\ViteEtGourmand\Service\MailService;


class AuthController
{
    private CompteRepository $compteRepository;
    private MailService $mailService;
    private TokenRepository $tokenRepository;


    public function __construct(CompteRepository $compteRepository, MailService $mailService, TokenRepository $tokenRepository)
    {
        $this->compteRepository = $compteRepository;
        $this->mailService = $mailService;
        $this->tokenRepository = $tokenRepository;
    }


    public function showRegister(): void
    {
        require __DIR__ . '/../../templates/auth/register.php';
    }

    public function register(): void
    {
        $name = $_POST['name'];
        $firstname = $_POST['firstname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $adress = $_POST['adress'];
        $adressAptInput = $_POST['adressAptInput'];
        $postalCode = $_POST['postalCode'];
        $city = $_POST['city'];
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
            header('location:/?page=register');
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
                header('location:/?page=register');
                exit;
            }
        } else {
                $_SESSION['erreurDifferentPassword'] = "Le mot de passe ne correspond pas au mot de passe initial saisi, veuillez corriger.";
                header('location:/?page=register');
                exit;
        }
        unset($_SESSION['saveSaisieRegister']);

        $_SESSION['successRegister'] = "Votre compte est créé. Vous pouvez vous identifier ci-dessous.";                
        header('location:/?page=login');
        exit;
    }

    public function showLogin(): void {
        require __DIR__ . '/../../templates/auth/login.php';
    }

    public function login(): void
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $resultMail = $this->compteRepository->findByEmail($email);

        if ($resultMail !== null) {
        if (password_verify($password, $resultMail['mot_de_passe_hash'])) {
            if ($resultMail['actif'] !== 1) {
                $_SESSION['erreurActif'] = "Vous ne pouvez pas vous connecter, votre compte est inactif.";
                header('location:/?page=login');
                exit;
            }
            $_SESSION['user_id'] = $resultMail['id'];
            $_SESSION['user_email'] = $resultMail['email'];
            $_SESSION['user_nom'] = $resultMail['nom'];
            $_SESSION['user_prenom'] = $resultMail['prenom'];
            $_SESSION['user_role'] = $resultMail['role'];
            if ($_SESSION['user_role'] === 'admin' || $_SESSION['user_role'] === 'employe') {
                header('location:/?page=admin');
                exit;
            } header('location:/?page=home');
                exit;
        }else {
            $_SESSION['erreurCompte'] = "L'email ou le mot de passe est incorrect, veuillez réessayer ou nous contacter.";
            header('location:/?page=login');
            exit;
        }
    } else {
            $_SESSION['erreurCompte'] = "L'email ou le mot de passe est incorrect, veuillez réessayer ou nous contacter.";
            header('location:/?page=login');
            exit;
        }
    }

    public function logout(): void {
        $_SESSION = [];
        session_destroy();
        header('location:/?page=login');
        exit;
    }


# Fonction qui redirige vers la page login si le role est non admin ou non connecté 
    public function checkAdmin(): void {
        if((!isset($_SESSION ['user_id'])) || $_SESSION['user_role'] !== 'admin') {
            header('location:/?page=login');
            exit;
        }
    }

# Fonction qui redirige vers la page login si le role est non admin/employe ou non connecté 
    public function checkEmploye(): void {
        if((!isset($_SESSION ['user_id'])) || (($_SESSION ['user_role']) !== 'admin') && (($_SESSION ['user_role']) !== 'employe') ) {
            header('location:/?page=login');
            exit;
        }
    }

    # Fonction qui redirige vers la page login si l'utilisateur n'est pas encore connecté    
    public function checkLogin(): void {
        if(!isset($_SESSION['user_id'])) {
            header('location:/?page=login');
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
        $nameEmploye = $_POST['nameEmploye'];
        $prenomEmploye = $_POST['prenomEmploye'];
        $adressEmploye = $_POST['adressEmploye'];
        $complAdressEmploye = $_POST['complAdressEmploye'];
        $postalEmploye = $_POST['postalEmploye'];
        $communeEmploye = $_POST['communeEmploye'];
        $emailEmploye = $_POST['emailEmploye'];
        $telEmploye = $_POST['telEmploye'];
        $passwordEmploye = $_POST['passwordEmploye'];
        //Rôle 'employe' mis en dur car à la création par l'admin on ne peut être que 'employe' > cela empêche une modification via l'inspecteur
        $roleEmploye = 'employe';

        $hashedPassword = password_hash($passwordEmploye, PASSWORD_BCRYPT);
        $this->compteRepository->create($emailEmploye, $hashedPassword, $nameEmploye, $prenomEmploye, $telEmploye, $adressEmploye, $complAdressEmploye, $postalEmploye, $communeEmploye, $roleEmploye);
        
        $body = "Bonjour $prenomEmploye $nameEmploye, \n Votre compte Employé a été créé. \n Vous trouverez ci-dessous votre identifiant de connexion : \n Votre identifiant : $emailEmploye \n Votre mot de passe vous sera communiqué par l'administrateur. \n Vite & Gourmand";
        $this->mailService->sendMail($emailEmploye, "Bienvenue chez Vite et Gourmand - Création de compte", $body);

        header('location:/?page=admin');
        exit;
    }

    public function showEmploye(): void {
        $employes = $this->compteRepository->findAllEmploye();
        require __DIR__ . '/../../templates/admin/employes.php';
    }

    public function toggleActif(): void
    {
        $this->compteRepository->toggleActif($_POST['id']);
        header('location:/?page=employes');
        exit;
    }
    
    public function showInfospersonal(): void 
    {
        if(!isset($_SESSION['user_id'])) {
            header('location:/?page=login');
            exit;
        } 
        $infoPersonal = $this->compteRepository->findById($_SESSION['user_id']);

        require __DIR__ . '/../../templates/client/infos_personnelles.php';
    }

    public function updateInfosPersonal(): void
    {
         if(!isset($_SESSION['user_id'])) {
            header('location:/?page=login');
            exit;
        } 

        $name = $_POST['name'];
        $firstname = $_POST['firstname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $adress = $_POST['adress'];
        $adressAptInput = $_POST['adressAptInput'];
        $postalCode = $_POST['postalCode'];
        $city = $_POST['city'];
        $id = $_SESSION['user_id'];

        $checkEmail = $this->compteRepository->findByEmail($email);
        if (($checkEmail !== null && $checkEmail['id'] !== $_SESSION['user_id'])) {
            $_SESSION['erreurEmailRegister'] = "Veuillez vérifier l'email saisi.";
            header('location:/?page=infos_personnelles');
            exit;
        }

        $this->compteRepository->update($email, $name, $firstname, $phone, $adress, $adressAptInput, $postalCode, $city, $id);

        $_SESSION['user_nom'] = $name;
        $_SESSION['user_prenom'] = $firstname;
        $_SESSION['user_email'] = $email;

        $_SESSION['successUpdate'] = "Les modifications ont bien été prises en compte.";                
        header('location:/?page=compte_client');
        exit;
    }

    public function showPasswordForget(): void 
    {
        require __DIR__ . '/../../templates/auth/password_forget.php';
        
    }

    public function passwordForget() 
    {
        $email = $_POST['email'];
        $checkEmail = $this->compteRepository->findByEmail($email);
        
        if ($checkEmail !== null) {
            $newToken = bin2hex(random_bytes(32));
            $this->tokenRepository->deleteToken($checkEmail['id']);
            $this->tokenRepository->create($newToken, $checkEmail['id']);
            $linkReinit = $_ENV['APP_URL'] . '/?page=password_reset&token=' . $newToken;
            $nom = $checkEmail['nom'];
            $prenom = $checkEmail['prenom'];

            $body = "Bonjour $prenom $nom, \nVous avez demandé à réinitialiser votre mot de passe Vite & Gourmand. \nCliquez sur le lien ci-dessous pour en choisir un nouveau : $linkReinit \nCe lien est valable 1 heure. \nSi vous n’êtes pas à l’origine de cette demande, ignorez simplement ce message, votre mot de passe actuel reste inchangé. \nVite & Gourmand";
            $this->mailService->sendMail($email, "Vite et Gourmand - Réinitialisation mot de passe", $body);

        }    
        $_SESSION['successPasswordForget'] = "Un message a été envoyé à l'adresse indiquée, si votre adresse correspond à un compte.";                
        header('location:/?page=password_forget');
        exit;      
    }

    public function showPasswordReset() 
    {
        $token = $_GET['token'] ?? '';
        $tokenValide = $this->tokenRepository->findByToken($token);

        if($tokenValide === null)
            {
            $_SESSION['erreurPasswordReset'] = "Ce lien n’est plus valide. Veuillez refaire une demande.";                
            header('location:/?page=password_forget');
            exit;  
            }

        require __DIR__ . '/../../templates/auth/password_reset.php';

    }

    public function passwordReset() 
    {
        $token = $_GET['token'] ?? '';
        $password = $_POST['password'];
        $passwordConfirm = $_POST['passwordConfirm'];
        

        $tokenValide = $this->tokenRepository->findByToken($token);
        if($tokenValide === null)
            {
            $_SESSION['erreurPasswordReset'] = "Ce lien n’est plus valide. Veuillez refaire une demande.";                
            header('location:/?page=password_forget');
            exit;  
            }
            $compte_id = $tokenValide['compte_id'];
            $compte = $this->compteRepository->findById($compte_id);
            $prenom = $compte['prenom'];
            $email = $compte['email'];

        if ($password === $passwordConfirm) {
            if (
                preg_match('/[A-Z]/', $password)
                && preg_match('/[a-z]/', $password)
                && preg_match('/[0-9]/', $password)
                && preg_match('/[^a-zA-Z0-9]/', $password)
                && strlen($password) >= 10
            ) {
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                $this->compteRepository->updatePassword($hashedPassword, $compte_id );

                $this->tokenRepository->deleteToken($compte_id);
                                
                $body = "Bonjour $prenom,\n Votre mot de passe a été modifié.\n  À très bientôt, L'équipe de Vite & Gourmand";
                $this->mailService->sendMail($email, "Réinitialisation de votre mot de passe", $body);
                $_SESSION['successUpdatePassword'] = "Votre mot de passe a correctement été modifié"; 
                header('location:/?page=login');
                exit;

            } else {
                $_SESSION['erreurFormResetPassword'] = "Le mot de passe ne respecte pas le format attendu : Votre mot de passe doit contenir au moins :
                10 caractères, 1 majuscule, 1 minuscule, 1 chiffre, 1 caractère spécial.";
                header('location:/?page=password_reset&token=' . $token);
                exit;
            }
        } else {
                $_SESSION['erreurDifferentResetPassword'] = "Le mot de passe ne correspond pas au mot de passe initial saisi, veuillez corriger.";
                header('location:/?page=password_reset&token=' . $token);
                exit;
        }
    }


}


