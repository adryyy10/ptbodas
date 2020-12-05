<?php

namespace App\Handler;

use App\Entity\Ascensores;
use App\Interfaces\AscensoresInterface as AscensoresInterface;
use App\Repository\AscensoresRepository;

class AscensorHandler implements AscensoresInterface
{
    protected $ascensoresRepository;

    public function __construct(AscensoresRepository $ascensoresRepository)
    {
        $this->ascensoresRepository = $ascensoresRepository;
    }

    // Buscamos todos los ascensores en el respositorio
    public function searchAllAscensores()
    {
        return $this->ascensoresRepository->findAll();
    }

    // Extraemos de todos los ascensores, el primero disponible
    public function getAscensorLibre()
    {
        $ascensorDisponible = new Ascensores;
        $ascensores = $this->searchAllAscensores();
        /* Cogemos el ascensor libre */
        foreach ($ascensores as $ascensor) {
            if($ascensor->getDisponible() == 1){
                $ascensorDisponible = $ascensor;
                break;
            }
            
        }
        return $ascensorDisponible;
    }
}