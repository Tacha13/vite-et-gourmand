<?php

namespace Tacha\ViteEtGourmand\Service;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailService {

        private string $hostMail;
        private int $portMail;
        private string $usernameMail;
        private string $passwordMail;

    public function __construct()
    {
        $this->hostMail = $_ENV['MAIL_HOST'];
        $this->portMail = $_ENV['MAIL_PORT'];
        $this->usernameMail = $_ENV['MAIL_USERNAME'];
        $this->passwordMail = $_ENV['MAIL_PASSWORD'];
     
    }

    public function sendMail(string $to, string $subject, string $body) {

   try {

//SMTP Configuration
        $email = new PHPMailer(true);
        $email->isSMTP();
        $email->Host = $this->hostMail;
        $email->Port = $this->portMail;
        $email->SMTPAuth = true;
//désactivation forçage tls en develop - à retirer en prod
        $email->SMTPSecure = '';
        $email->SMTPAutoTLS = false;
//        
        $email->Username = $this->usernameMail;
        $email->Password = $this->passwordMail;

//Sender et body configuration

        $email->setFrom('noreply@vitetgourmand.fr', 'From name');
        $email->addAddress($to);
        $email->Subject = $subject;
        $email->Body = $body;
        $email->send();

        echo "Message envoyé";

    } catch (Exception $e) {
        echo "Erreur de mail : " . $e->getMessage();
    }
    }

}
