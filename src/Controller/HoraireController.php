<?php


namespace Tacha\ViteEtGourmand\Controller;

use Tacha\ViteEtGourmand\Repository\HoraireRepository;

class HoraireController 
{
    private HoraireRepository $horaireRepository;

    public function __construct(HoraireRepository $horaireRepository)
    {
        $this->horaireRepository = $horaireRepository;
    }

    public function showHoraires(): void
    {
        $horaires = $this->horaireRepository->findAll();
        require __DIR__ . '/../../templates/admin/admin_horaires.php';
    }

}