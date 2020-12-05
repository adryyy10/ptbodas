<?php

namespace App\Interfaces;

use App\Entity\Peticiones;

interface PeticionesInterface 
{
    public function flushPeticion(Peticiones $peticion);
}