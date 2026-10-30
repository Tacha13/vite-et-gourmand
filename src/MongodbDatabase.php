<?php
namespace Tacha\ViteEtGourmand;

use MongoDB\Client;


class MongodbDatabase {
    
    private \MongoDB\Database $mongoBase;

    public function __construct()
    {
        $mongoUri = $_ENV['MONGO_URI'];
        $mongoDb = $_ENV['MONGO_DB'];

        $client = new Client($mongoUri);
        $this->mongoBase = $client->selectDatabase($mongoDb);
        
    }

    public function getConnection(): \MongoDB\Database {
        return $this->mongoBase;
    }
}