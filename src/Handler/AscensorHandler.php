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
        return 'No hay ascensores disponibles';
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

    public function setNuevoRecorridoAscensor($ascensor, $distanciaRecorrida)
    {
        $ascensor = $this->searchAscensor($ascensor);
        $distanciaTotal = $ascensor->getDistanciaTotal() + $distanciaRecorrida;
        $ascensor->setDistanciaTotal($distanciaTotal);
        $this->flushAscensor();
    }

    public function getAscensorOptimo(array $ascensores)
    {
        $recorridoMaximoAscensor = 0;
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