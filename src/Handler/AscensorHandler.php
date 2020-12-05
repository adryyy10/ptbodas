<?php

namespace App\Handler;

use App\Repository\AscensoresRepository;
use AscensoresInterface;

class AscensorHandler implements AscensoresInterface
{
    protected $ascensoresRepository;

    public function __construct(AscensoresRepository $ascensoresRepository)
    {
        $this->ascensoresRepository = $ascensoresRepository;
    }

    public function searchAllAscensores()
    {
        return $this->ascensoresRepository->findAll();
    }

    public function getAscensorLibre(){
        
    }
}