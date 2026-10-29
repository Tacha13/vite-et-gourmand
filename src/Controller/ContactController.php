<?php

namespace Tacha\ViteEtGourmand\Controller;

use Tacha\ViteEtGourmand\Service\MailService;

class ContactController {
        private MailService $mailService;

        public function __construct(MailService $mailService)
    {
        $this->mailService = $mailService;
    }

    public function showContact(): void
    {
        require __DIR__ . '/../../templates/contact.php';
    }

    public function sendContact(): void
    {
        $nomContact = htmlspecialchars($_POST['nomContact']);
        $prenomContact = htmlspecialchars($_POST['prenomContact']);
        $emailContact = htmlspecialchars($_POST['emailContact']);
        $phoneContact = htmlspecialchars($_POST['phoneContact']);
        $subjectContact = htmlspecialchars($_POST['subjectContact']);
        $messageContact = htmlspecialchars($_POST['messageContact']);

        $body = "Bonjour Vite et Gourmand. Vous avez reçu un message de $prenomContact $nomContact. Voici le sujet : $subjectContact et le contenu : $messageContact. ";
        $responseContact = $this->mailService->sendMail('contact@vitegourmand.fr', $subjectContact, $body);

        //Envoi du mail entreprise avant celui du client pour vérifier que l'ensemble de la chaîne aboutit et sans lui personne ne traite la demande, ensuite le mail client
        //Attention, Mailtrap bloque l'envoi des mails si successifs en dev : le mail du client peut être bloqué en dev;

        $body = "Bonjour $prenomContact $nomContact. Merci pour votre message ! L'équipe Vite & Gourmand a bien reçu votre demande. Nous vous répondrons rapidement afin de vous accompagner au mieux.";

        $this->mailService->sendMail($emailContact, "Vite et Gourmand", $body);

        if ($responseContact === true) {
           $_SESSION['contactSendSuccess'] = "Votre demande a été envoyée";
        } else {$_SESSION['contactSendFailure'] = "Votre demande n'a pas pu être envoyée";
        }
        header('location:/?page=contact');
        exit;
        
    }

}