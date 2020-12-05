<?php

namespace App\DataFixtures;

use App\Entity\Ascensores;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AscensorFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        //Instanciamos ascensor 1
        $ascensor = new Ascensores;
        //Seteamos valores iniciales
        $ascensor->setPosicion(0);
        $ascensor->setDistanciaTotal(0);
        $ascensor->setDisponible(true);
        //Persistimos en memoria
        $manager->persist($ascensor);

        //Instanciamos ascensor 2
        $ascensor2 = new Ascensores;
        //Seteamos valores iniciales
        $ascensor2->setPosicion(0);
        $ascensor2->setDistanciaTotal(0);
        $ascensor2->setDisponible(true);
        //Persistimos en memoria
        $manager->persist($ascensor2);

        //Instanciamos ascensor 3
        $ascensor3 = new Ascensores;
        //Seteamos valores iniciales
        $ascensor3->setPosicion(0);
        $ascensor3->setDistanciaTotal(0);
        $ascensor3->setDisponible(true);
        //Persistimos en memoria
        $manager->persist($ascensor3);


        //Añadimos en DB
        $manager->flush();
    }
}
