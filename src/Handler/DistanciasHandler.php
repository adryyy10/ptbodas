<?php

namespace App\Handler;

use App\Entity\Ascensores;
use App\Entity\DistanciaAscensorSolicitud;
use App\Interfaces\DistanciasInterface;
use App\Repository\DistanciaAscensorSolicitudRepository;
use Doctrine\ORM\EntityManagerInterface;

class DistanciasHandler implements DistanciasInterface
{

    protected $entityManager;
    protected $distanciaAscensorSolicitudRepository;
    public function __construct(EntityManagerInterface $entityManager, DistanciaAscensorSolicitudRepository $distanciaAscensorSolicitudRepository)
    {
        $this->entityManager = $entityManager;
        $this->distanciaAscensorSolicitudRepository = $distanciaAscensorSolicitudRepository;
    }

    //Hacemos flush de la distancia recorrida en ese momento por el ascensor, con su solicitud
    public function createNewDistanciaTotalBySolicitud(int $distanciaTotal, Ascensores $ascensorDisponible, int $peticionId)
    {
        $distanciaBySolicitud = new DistanciaAscensorSolicitud;
        $distanciaBySolicitud->setDistanciaTotal($distanciaTotal);
        $distanciaBySolicitud->setAscensor($ascensorDisponible);
        $distanciaBySolicitud->setPeticion($peticionId);

        $this->flushDistancia($distanciaBySolicitud);
    }

    public function flushDistancia(DistanciaAscensorSolicitud $distanciaAscensorSolicitud)
    {
        $this->entityManager->persist($distanciaAscensorSolicitud);
        $this->entityManager->flush();
    }

    public function getDistancias(): array
    {
        return $this->distanciaAscensorSolicitudRepository->findAll();
    }
}