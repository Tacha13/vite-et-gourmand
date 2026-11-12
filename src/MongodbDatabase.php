<?php
namespace Tacha\ViteEtGourmand;

use MongoDB\Client;


class MongodbDatabase {
    
    private \MongoDB\Database $mongoBase;

//Fonction qui permet de se connecter à la base MongoDB Atlas avec les infos renseignées dans le fichier .env
    public function __construct()
    {
        $mongoUri = $_ENV['MONGO_URI'];
        $mongoDb = $_ENV['MONGO_DB'];

        $client = new Client($mongoUri, [], ['disableClientPersistence' => true]);
        //$client = new Client($mongoUri); remplacé par la ligne du dessus suite au pb de rechargement du locahost, coupure atlas
        $this->mongoBase = $client->selectDatabase($mongoDb);
        
    }

//Fonction qui renvoie la connexion créé
    public function getConnection(): \MongoDB\Database {
        return $this->mongoBase;
    }
}