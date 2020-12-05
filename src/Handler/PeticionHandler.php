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
    protected $ascensorHandler;

    // Pasamos por inversion de dependencias el entityManager y el respositorio de peticiones
    public function __construct(EntityManagerInterface $entityManager, PeticionesRepository $peticionesRepository, AscensorHandler $ascensorHandler)
    {
        $this->peticionesRepository = $peticionesRepository;
        $this->entityManager = $entityManager;
        $this->ascensorHandler = $ascensorHandler;
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

    // Buscamos todos las peticiones en el respositorio
    public function searchAllPeticiones(): array
    {
        return $this->peticionesRepository->findAll();
    }

    public function loadAllPeticiones()
    {
        //Secuencia 1
        $this->setPeticiones(9,11,5,0,2);
        //Secuencia 2
        $this->setPeticiones(9,10,10,0,1);
        //Secuencia 3
        $this->setPeticiones(11,18,20,0,1);
        $this->setPeticiones(11,18,20,0,2);
        $this->setPeticiones(11,18,20,0,3);
        //Secuencia 4
        $this->setPeticiones(14,15,4,1,0);
        $this->setPeticiones(14,15,4,2,0);
        $this->setPeticiones(14,15,4,3,0);
    }

    public function setPeticiones($inicio, $final, $intervalo, $origen, $destino){
    
        //Distancia reccorida para el ascensor
        $distanciaRecorrida = abs($origen-$destino);
    
        // Mientras no lleguemos al final, vamos iterando en los intervalos establecidos
          for ($i = $inicio; $i < $final; $i++){
            for ($j = 0; $j < 60; $j+=$intervalo){
    
                //Buscamos el primer ascensor disponible
                $ascensorDisponible = $this->ascensorHandler->getAscensorLibre();
    
                //Actualizamos los pisos recorridos por dicho ascensor
                $this->ascensorHandler->setNuevoRecorridoAscensor($ascensorDisponible, $distanciaRecorrida);
    
                //Actualizamos posicion del ascensor
                $this->ascensorHandler->setPosicion($ascensorDisponible,$destino);
                
                //Insertamos en la Tabla Solicitudes, nuestra nueva solicitud con el ascensor asignado
                $this->createNewPeticion($ascensorDisponible, $inicio, $final, $origen, $destino, $distanciaRecorrida);
    
                //Setear el nuevo ascensor ocupado a disponible otra vez ya que ha acabado su solicitud
                $ascensorDisponible = $this->ascensorHandler->setAscensorLibre($ascensorDisponible);
            }
    
          }
        }

}