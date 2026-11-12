<?php

namespace Tacha\ViteEtGourmand\Controller;


class PageLegaleController 
{
//Fonction qui affiche le template des mentions légales
    public function showMentionsLegales(): void
    {
        require __DIR__ . '/../../templates/mentions_legales.php';
    }

//Fonction qui affiche le template des CGV
    public function showCgv(): void
    {
        require __DIR__ . '/../../templates/cgv.php';
    }
}