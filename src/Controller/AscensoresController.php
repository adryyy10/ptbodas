<?php

namespace App\Controller;

use App\Entity\Ascensores;
use App\Handler\AscensorHandler as AscensorHandler;
use App\Handler\PeticionHandler;
use App\Repository\AscensoresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AscensoresController extends AbstractController
{

    protected $ascensoresRepository;
    protected $ascensorHandler;
    protected $peticionHandler;

    public function __construct(AscensoresRepository $ascensoresRepository, AscensorHandler $ascensorHandler, PeticionHandler $peticionHandler)
    {
        $this->ascensoresRepository = $ascensoresRepository;
        $this->ascensorHandler = $ascensorHandler;
        $this->peticionHandler = $peticionHandler;
    }

    /**
     * @Route("/ascensores", name="ascensores")
     */
    public function index(): Response
    {
        //Llamamos a nuestros ascensores creados previamente con FixturesBundle
        $arrayAscensores = $this->ascensorHandler->searchAllAscensores();

        $this->setSolicitudes(9,11,5,0,2);


        return $this->render('ascensores/index.html.twig', [
            "ascensores" => $arrayAscensores,
            'controller_name' => 'AscensoresController',
        ]);
    }

    public function setSolicitudes($inicio, $final, $intervalo, $origen, $destino){
    
    //Distancia reccorida para el ascensor
    $distanciaRecorrida = abs($origen-$destino);
    $ascensorDisponible = new Ascensores;

    // Mientras no lleguemos al final, vamos iterando en los intervalos establecidos
      for ($i = $inicio; $i <= $final; $i++){
        for ($j = 0; $j < 60; $j+=$intervalo){

            //Buscamos el primer ascensor disponible
            $ascensorDisponible = $this->ascensorHandler->getAscensorLibre();
            //dd($ascensorDisponible);

            //Actualizamos los pisos recorridos por dicho ascensor
            $this->ascensorHandler->setNuevoRecorridoAscensor($ascensorDisponible, $distanciaRecorrida);
            
            //Insertamos en la Tabla Solicitudes, nuestra nueva solicitud con el ascensor asignado
            $this->peticionHandler->createNewPeticion($ascensorDisponible, $inicio, $final, $origen, $destino, $distanciaRecorrida);
        }
        //Setear el nuevo ascensor ocupado a disponible otra vez ya que ha acabado su solicitud
        //$ascensorDisponible
      }
    }

}
