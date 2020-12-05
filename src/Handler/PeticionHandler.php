<?php

namespace App\Handler;

use App\Entity\Peticiones;
use App\Interfaces\PeticionesInterface;
use App\Repository\PeticionesRepository;
use Doctrine\ORM\EntityManagerInterface;

class PeticionHandler implements PeticionesInterface
{

    protected $peticionesRepository;
    protected $entityManager;

    // Pasamos por inversion de dependencias el entityManager y el respositorio de peticiones
    public function __construct(EntityManagerInterface $entityManager, PeticionesRepository $peticionesRepository)
    {
        $this->peticionesRepository = $peticionesRepository;
        $this->entityManager = $entityManager;
    }

    //Hacemos flush de la peticion
    public function flushPeticion($peticion)
    {
        $this->entityManager->persist($peticion);
        $this->entityManager->flush();
    }

    //Creamos nueva peticion en la tabla Peticiones
    public function createNewPeticion($ascensor, $inicio,$final,$origen,$destino,$distancia)
    {
        $peticion = new Peticiones;
        $peticion->setAscensor($ascensor);
        $peticion->setInicio($inicio);
        $peticion->setFinal($final);
        $peticion->setOrigen($origen);
        $peticion->setDestino($destino);
        $peticion->setDistancia($distancia);

        $this->flushPeticion($peticion);
    }

}