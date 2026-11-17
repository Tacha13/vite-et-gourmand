# vite-et-gourmand

Site en ligne : https://vite-et-gourmand-nd.alwaysdata.net

## Description

Projet de création de site web pour le traiteur Vite & Gourmand dans le cadre de l'obtention du titre professionnel DWWM.

## Stack technique

Environnement : 
- Docker avec MariaDB + phpMyAdmin
- ou XAMPP avec MySQL + phpMyAdmin

Front-end : 
- HTML5
- CSS 
- Framework Bootstrap 5.3.8

Back-end : 

- PHP 8.4 
- Composer
- phpdotenv
- PHPMailer

BDD relationnelle : 
- MySql via XAMPP
- MariaDB  via Docker


BDD NoSql : 
- MongoDB Atlas

Mail : 
- MailTrap


## Installation locale

Veuillez suivre les étapes ci-dessous pour installer le projet en local :

1.  Cloner le projet

```git clone https://github.com/Tacha13/vite-et-gourmand```

2. Se positionner sur le dossier projet

```cd vite-et-gourmand```


## Installation XAMPP

### Installation Composer

```composer install```


### Installation .env

Copier .env.example et le nommer .env.

- DB_USER et DB_PASSWORD : Indiquer vos identifiants MySQL
- DB_PORT = indiquer le port choisi dans la section suivante "Démarrer MySQL"

MAIL_USERNAME et MAIL_PASSWORD : identifiants de votre compte Mailtrap.
- Créer un compte gratuit  : https://mailtrap.io/
- dans votre compte -> sélectionner sandbox à gauche > cliquer sur My sandbox > dans l'onglet SMTP, récupérer les informations de connexions et copier les.

### Démarrer MySQL via XAMPP

- Avec MySQL standard ou XAMPP : port 3306
- Si MySQL est installé et tourne en même temps que XAMPP, il convient de modifier le port de XAMPP et d'indiquer 3307 : Dans XAMPP, sur la ligne MySQL, sélectionner Config puis my.ini.
Rechercher port=3306 (sous la zone MySQL clients et The MySQL server) et remplacer par 3307, sauvegarder et fermer le fichier.

### Base de données

- Créer la base de  données vite_et_gourmand.
- Importer le fichier .sql :
    1. dans phpMyAdmin, sélectionner la base vite_et_gourmand
    2. puis importer
    3. dans la zone fichier à importer, sélectionner les fichiers disponibles ```/database/schema.sql``` dans un premier temps puis ```/database/donnees.sql```

### Lancer le serveur PHP 

```php -S localhost:8000 -t public```

### Se connecter au site

- Dans le navigateur, taper l'url suivante : http://localhost:8000/


## Installation Docker

Prérequis : avoir Docker Desktop installé et lancé.

### Installation .env.docker

Copier .env.docker.example et le nommer .env.docker

- DB_USER / MARIADB_USER : créer le même identifiant
- DB_PASSWORD / MARIADB_PASSWORD : créer le même mot de passe
- MARIADB_ROOT_PASSWORD : créer un autre mot de passe pour root
- Remplir MONGO_URI et les lignes de Mailtrap comme dans le .env


### Démarrer l'application avec Docker (Docker contient 3 conteneurs : le site, MariaDB, phpMyAdmin qui démarrent ensemble et sont isolés)

- Saisir docker compose up --build dans le terminal (lance la construction de l'image du site avec le dockerfile et démarre les 3 conteneurs)
NB : au premier lancement, les tables de schema.sql et donnees.sql sont créées et remplies.
- dans un deuxième terminal (laisser le premier ouvert, il sert à l'exécution de Docker et de l'application) exécuter la commande suivante : 
    * docker compose exec app composer install
    Cette commande permet de lire les bibliothèques de composer.json et de les télécharger dans le dossier vendor.

### Lancer l'application en local

- accès avec http://localhost:8080/

### Base de données

- accès à phpMyAdmin via le site http://localhost:8081/
- Indiquer les identifiants renseignés dans le fichier .env.docker MARIADB_USER et MARIADB_PASSWORD

### Arrêter le service Docker

2 façons : 
- soit avec CTRL + C
- soit avec la commande : docker compose down


## Identifiants de connexion au site test

- Compte administrateur : gourmandjo@mail.fr / Gourmand_Admin_1
- Compte employé : gourmand.f@mail.fr / Gourmand_Empl_1
- Compte client : cduss@mail.fr / Toto1_vaAlaplage

