<?php

namespace App\Interfaces;

use App\Entity\Ascensores;

interface AscensoresInterface 
{

    public function searchAllAscensores(): array;

    public function searchAscensor(Ascensores $ascensor);

    public function flushAscensor();
}