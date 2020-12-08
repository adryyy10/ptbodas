<?php

namespace App\Interfaces;

use App\Entity\Peticiones;

interface PeticionesInterface 
{
    public function flushPeticion(Peticiones $peticion);

    public function setPeticiones(int $inicio,int $final,int $intervalo,int $origen,int $destino);
}