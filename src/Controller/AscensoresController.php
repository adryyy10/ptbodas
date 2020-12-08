<?php

namespace App\Controller;

use App\Entity\Ascensores;
use App\Handler\AscensorHandler as AscensorHandler;
use App\Handler\DistanciasHandler;
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
    protected $distanciasHandler;

    public function __construct(AscensoresRepository $ascensoresRepository, AscensorHandler $ascensorHandler, PeticionHandler $peticionHandler, DistanciasHandler $distanciasHandler)
    {
        $this->ascensoresRepository = $ascensoresRepository;
        $this->ascensorHandler = $ascensorHandler;
        $this->peticionHandler = $peticionHandler;
        $this->distanciasHandler = $distanciasHandler;
    }

    /**
     * @Route("/ascensores", name="ascensores")
     */
    public function index(): Response
    {
        //Llamamos a nuestros ascensores creados previamente con FixturesBundle
        $ascensores = $this->ascensorHandler->searchAllAscensores();

        //Insertamos todas las peticiones de golpe
        //$this->peticionHandler->loadAllPeticiones();
        
        //Recogemos todas las peticiones
        $peticiones = $this->peticionHandler->searchAllPeticiones();

        //Recogemos todas las distancias recorridas en base a la peticion y el ascensor
        $distancias = $this->distanciasHandler->getDistancias();

        return $this->render('ascensores/index.html.twig', [
            "ascensores" => $ascensores,
            "peticiones" => $peticiones,
            "distancias" => $distancias,
            'controller_name' => 'AscensoresController',
        ]);
    }

}
