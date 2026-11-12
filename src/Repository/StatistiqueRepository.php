<?php

namespace Tacha\ViteEtGourmand\Repository;

use Tacha\ViteEtGourmand\MongodbDatabase;

class StatistiqueRepository {

    private MongodbDatabase $mongoBase;

    public function __construct(MongodbDatabase $mongoBase)
    {
        $this->mongoBase = $mongoBase;
    }

//Fonction qui crée une fiche MongoDB
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

//Fonction qui regroupe toutes les fiches par menu, compte les commandes et additionne le CA avec les filtres
    public function findStatParMenu(?string $nomMenu, ?string $dateDebutPrestation, ?string $dateFinPrestation): array 
    {
        $mongodb = $this->mongoBase->getConnection();
        $infoFicheCommande = $mongodb->selectCollection('stat_commandes');

        $filtre = [];

        if($nomMenu !== null && $nomMenu !== '') {
            $filtre['nomMenu'] = $nomMenu;
        }

        if($dateDebutPrestation !== null && $dateDebutPrestation !== '') {
            $filtre['datePrestation'] ['$gte'] = $dateDebutPrestation;
        }

        if($dateFinPrestation !== null && $dateFinPrestation !== '') {
            $filtre['datePrestation'] ['$lte'] = $dateFinPrestation;
        }

        $pipeline = [];
        if(!empty($filtre)) {
            $pipeline[] = ['$match' => $filtre];
        }
        $pipeline[] = ['$group' => [
                '_id' => '$nomMenu',
                'nbCommandes' => ['$sum' => 1],
                'chiffreAffaire' => ['$sum' => '$prixTotal']
            ]];

        $pipeline[] = ['$sort' => ['_id' => 1]];

        return $infoFicheCommande->aggregate($pipeline)->toArray();
    }

//Fonction qui récupère la liste des noms de menus
    public function findNomMenu(): array 
    {
        $mongodb = $this->mongoBase->getConnection();
        $infoFicheCommande = $mongodb->selectCollection('stat_commandes');

        $listNomsMenus[] = ['$group' => [
                '_id' => '$nomMenu',
            ]];
        
        $listNomsMenus[] = ['$sort' => ['_id' => 1]];

        return $infoFicheCommande->aggregate($listNomsMenus)->toArray();
    }
}