<?php

namespace App\Handler;

use App\Entity\Ascensores;
use App\Interfaces\AscensoresInterface as AscensoresInterface;
use App\Repository\AscensoresRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AscensorHandler implements AscensoresInterface
{
    protected $ascensoresRepository;
    protected $entityManager;

    // Pasamos por inversion de dependencias el entityManager y el respositorio de ascensores
    public function __construct(EntityManagerInterface $entityManager, AscensoresRepository $ascensoresRepository)
    {
        $this->ascensoresRepository = $ascensoresRepository;
        $this->entityManager = $entityManager;
    }

    // Buscamos todos los ascensores en el respositorio
    public function searchAllAscensores(): array
    {
        return $this->ascensoresRepository->findAll();
    }

    //Buscamos un solo ascensor
    public function searchAscensor($ascensor)
    {
        return $this->ascensoresRepository->find($ascensor->getId());
    }

    //Hacemos flush del ascensor
    public function flushAscensor()
    {
        $this->entityManager->flush();
    }

    // Extraemos de todos los ascensores, el primero disponible
    public function getAscensorLibre()
    {
        $ascensores = $this->searchAllAscensores();
        $ascensorOptimo = $this->getAscensorOptimo($ascensores);

        /* Cogemos el ascensor libre */
        foreach ($ascensores as $ascensor)
        {

            //Cogeremos el ascensor que esté disponible pero que también haya tenido menos desgaste de recorrido total
            if($ascensor->getDisponible() == 1 && $ascensor->getId() == $ascensorOptimo->getId())
            {
                $this->setAscensorOcupado($ascensor);
                return $ascensor;
            }
            
        }
        return $ascensorOptimo;
    }

    // Seteamos nuestro ascensor libre a ocupado para esta solicitud
    public function setAscensorOcupado($ascensor)
    {
        $ascensor = $this->searchAscensor($ascensor);
        $ascensor->setDisponible(0);
        $this->flushAscensor();
    }

    // Seteamos nuestro ascensor libre a ocupado para esta solicitud
    public function setAscensorLibre($ascensor)
    {
        $ascensor = $this->searchAscensor($ascensor);
        $ascensor->setDisponible(1);
        $this->flushAscensor();
    }

    public function setNuevoRecorridoAscensor($ascensor, $distanciaRecorrida): string
    {
        $ascensor = $this->searchAscensor($ascensor);
        $distanciaTotal = $ascensor->getDistanciaTotal() + $distanciaRecorrida;
        $ascensor->setDistanciaTotal($distanciaTotal);
        $this->flushAscensor();

        return $distanciaTotal;
    }

    public function setPosicion($ascensor, $destino): int
    {
        $ascensor = $this->searchAscensor($ascensor);
        $ascensor->setPosicion($destino);
        $this->flushAscensor();

        return $ascensor->getPosicion();
    }

    public function getAscensorOptimo(array $ascensores)
    {
        /**
         * Cogemos la distancia total recorrida del primer ascensor para que nos sirva 
         * de comparativo con el resto de ascensores y poder coger el que tiene menos rodaje 
        */
        $recorridoMaximoAscensor = $ascensores[0]->getDistanciaTotal();
        $ascensorOptimo = new Ascensores;
        foreach($ascensores as $ascensor)
        {
            if($ascensor->getDistanciaTotal() <= $recorridoMaximoAscensor){
                $ascensorOptimo = $ascensor;
            }
        }

        return $ascensorOptimo;
    }
}