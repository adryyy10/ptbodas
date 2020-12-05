<?php

namespace App\Controller;

use App\Handler\AscensorHandler as AscensorHandler;
use App\Repository\AscensoresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AscensoresController extends AbstractController
{

    protected $ascensoresRepository;

    public function __construct(AscensoresRepository $ascensoresRepository)
    {
        $this->ascensoresRepository = $ascensoresRepository;
    }

    /**
     * @Route("/ascensores", name="ascensores")
     */
    public function index(): Response
    {
        //Llamamos a nuestros ascensores creados previamente con FixturesBundle
        $ascensor = new AscensorHandler($this->ascensoresRepository);
        $arrayAscensores = $ascensor->searchAllAscensores();


        


        return $this->render('ascensores/index.html.twig', [
            "ascensores" => $arrayAscensores,
            'controller_name' => 'AscensoresController',
        ]);
    }

    public function getSolicitudes($inicio, $final, $intervalo, $origen, $destino){
    
    //Distancia reccorida en esa solicitud
    $distancia = abs($origen-$destino);

    // Mientras no lleguemos al final, vamos iterando en los intervalos establecidos
      for ($i = $inicio; $i <= $final; $i++){
        for ($j = 0; $j < 60; $j+=$intervalo){

        }
      }
    }

}
