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


        $body = "Bonjour $prenomContact $nomContact. Merci pour votre message ! L'équipe Vite & Gourmand a bien reçu votre demande. Nous vous répondrons rapidement afin de vous accompagner au mieux.";
        $this->mailService->sendMail($emailContact, "Vite et Gourmand", $body);

        //Temps de pause entre les deux sendMail car mailtrap bloque si le délai est trop court entre les deux envois
        //sleep(5);

        $body = "Bonjour Vite et Gourmand. Vous avez reçu un message de $prenomContact $nomContact. Voici le sujet : $subjectContact et le contenu : $messageContact. ";
        $this->mailService->sendMail('noreply@vitegourmand.fr', $subjectContact, $body);

        //header('location:http://localhost:8000/?page=menus');
        //exit;
    }

}