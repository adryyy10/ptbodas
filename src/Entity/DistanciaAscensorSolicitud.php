<?php

namespace App\Entity;

use App\Repository\DistanciaAscensorSolicitudRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DistanciaAscensorSolicitudRepository::class)
 */
class DistanciaAscensorSolicitud
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $distancia_total;

    /**
     * @ORM\ManyToOne(targetEntity=Ascensores::class, inversedBy="distanciaAscensorSolicitud")
     */
    private $ascensor;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $peticion;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDistanciaTotal(): ?string
    {
        return $this->distancia_total;
    }

    public function setDistanciaTotal(string $distancia_total): self
    {
        $this->distancia_total = $distancia_total;

        return $this;
    }

    public function getAscensor(): ?ascensores
    {
        return $this->ascensor;
    }

    public function setAscensor(?ascensores $ascensor): self
    {
        $this->ascensor = $ascensor;

        return $this;
    }

    public function getPeticion(): ?string
    {
        return $this->peticion;
    }

    public function setPeticion(string $peticion): self
    {
        $this->peticion = $peticion;

        return $this;
    }
}
