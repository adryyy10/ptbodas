<?php

namespace App\Interfaces;

use App\Entity\DistanciaAscensorSolicitud;

interface DistanciasInterface
{
    public function flushDistancia(DistanciaAscensorSolicitud $distanciaAscensorSolicitud);

    public function getDistancias(): array;
}