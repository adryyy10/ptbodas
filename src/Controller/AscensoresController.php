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
        $ascensores = $this->ascensorHandler->searchAllAscensores();

        //Insertamos todas las peticiones de golpe
        $this->peticionHandler->loadAllPeticiones();
        
        //Recogemos todas las peticiones
        $peticiones = $this->peticionHandler->searchAllPeticiones();

        return $this->render('ascensores/index.html.twig', [
            "ascensores" => $ascensores,
            "peticiones" => $peticiones,
            'controller_name' => 'AscensoresController',
        ]);
    }

}
