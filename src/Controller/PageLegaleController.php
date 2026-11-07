<?php

namespace Tacha\ViteEtGourmand\Controller;


class PageLegaleController 
{
     public function showMentionsLegales(): void
    {
        require __DIR__ . '/../../templates/mentions_legales.php';
    }
}