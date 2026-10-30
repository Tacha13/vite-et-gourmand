<?php

namespace Tacha\ViteEtGourmand\Repository;

use Tacha\ViteEtGourmand\MongodbDatabase;

class StatistiqueRepository {

    private MongodbDatabase $mongoBase;

    public function __construct(MongodbDatabase $mongoBase)
    {
        $this->mongoBase = $mongoBase;
    }

     public function createFiche(array $listCommande): void
    {
        $mongodb = $this->mongoBase->getConnection();
        $infoFicheCommande = $mongodb->selectCollection('stat_commandes');
        $infoFicheCommande->insertOne([
	        'numero' => $listCommande['numero'],
	        'nomMenu' => $listCommande['nomMenu'],
	        'prixTotal' => (float)$listCommande['prixTotal'],
	        'datePrestation' => $listCommande['datePrestation']
	    ]);

        
    }
}