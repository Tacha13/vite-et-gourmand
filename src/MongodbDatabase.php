<?php
namespace Tacha\ViteEtGourmand;

use MongoDB\Client;


class MongodbDatabase {
    
    private \MongoDB\Database $mongoBase;

    public function __construct()
    {
        $mongoUri = $_ENV['MONGO_URI'];
        $mongoDb = $_ENV['MONGO_DB'];

        $client = new Client($mongoUri, [], ['disableClientPersistence' => true]);
        //$client = new Client($mongoUri); remplacé par la ligne du dessus suite au pb de rechargement du locahost, coupure atlas
        $this->mongoBase = $client->selectDatabase($mongoDb);
        
    }

    public function getConnection(): \MongoDB\Database {
        return $this->mongoBase;
    }
}