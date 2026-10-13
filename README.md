# vite-et-gourmand

## Description

Projet de création de site web pour le traiteur Vite & Gourmand dans le cadre de l'obtention du titre professionnel DWWM.

## Stack technique

Front-end : 
- HTML5
- CSS 
- Framework Bootstrap 5.3.8

Back-end : 
- PHP 8.2.12
- Composer
- phpdotenv
- PHPMailer

BDD relationnelle : 
- MySql via XAMPP


BDD NoSql : 

Mail : 
- MailTrap


## Installation locale

Veuillez suivre les étapes ci-dessous pour installer le projet en local :

1.  Cloner le projet

```git clone https://github.com/Tacha13/vite-et-gourmand```

2. Se positionner sur le dossier projet

```cd vite-et-gourmand```

3. Installation Composer

```composer install```

## Installation .env

Copier .env.example et le nommer .env.

- DB_USER et DB_PASSWORD : Indiquer vos identifiants MySql
- DB_PORT = indiquer le port choisi dans la section suivante "Démarrer MySql"

MAIL_USERNAME et MAIL_PASSWORD : identifiants de votre compte Mailtrap.
- Créer un compte gratuit  : https://mailtrap.io/
- dans votre compte -> sélectionner sandbox à gauche > cliquer sur My sandbox > dans l'onglet SMTP, récupérer les informations de connexions et copier les.

## Démarrer MySql 

- Avec MySqL standard ou XAMPP : port 3306
- Si MySql est installé et tourne en même temps que XAMPP, il convient de modifier le port de XAMPP et d'indiquer 3307 : Dans XAMPP, sur la ligne MySQL, sélectionner Config puis my.ini.
Rechercher port=3306 (sous la zone MySQL clients et The MySQL server) et remplacer par 3307, sauvegarder et fermer le fichier.


## Base de données

- Créer la base de  données vite_et_gourmand.
- Importer le fichier .sql :
    1. dans PHPAdmin, sélectionner la base vite_et_gourmand
    2. puis importer
    3. dans la zone fichier à importer, sélectionner les fichier disponibles ```/database/schema.sql``` dans un premier temps puis ```/database/donnees.sql```
    

## Lancer le serveur PHP 

```php -S localhost:8000 -t public```

## Se connecter au site

- Dans le navigateur, taper l'url suivante : http://localhost:8000/

- Compte administrateur : gourmandjo@mail.fr / Gourmand_Admin_1
- Compte employé : gourmand.f@mail.fr / Gourmand_Empl_1
- Compte client : cduss@mail.fr / Toto1_vaAlaplage

