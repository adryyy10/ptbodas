<?php

namespace App\Controller;

use App\Entity\Ascensores;
use App\Handler\AscensorHandler as AscensorHandler;
use App\Repository\AscensoresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AscensoresController extends AbstractController
{

    protected $ascensoresRepository;
    protected $ascensorHandler;

    public function __construct(AscensoresRepository $ascensoresRepository, AscensorHandler $ascensorHandler)
    {
        $this->ascensoresRepository = $ascensoresRepository;
        $this->ascensorHandler = $ascensorHandler;
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
    $distancia = abs($origen-$destino);

    // Mientras no lleguemos al final, vamos iterando en los intervalos establecidos
      //for ($i = $inicio; $i <= $final; $i++){
        //for ($j = 0; $j < 60; $j+=$intervalo){

            //Buscamos el primer ascensor disponible
            $ascensorDisponible = $this->ascensorHandler->getAscensorLibre();
            dd($ascensorDisponible);
        //}
      //}
    }

}
