<?php

namespace App\Entity;

use App\Repository\PeticionesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PeticionesRepository::class)
 */
class Peticiones
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
    private $inicio;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $final;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $origen;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $destino;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $distancia;

    /**
     * @ORM\ManyToOne(targetEntity=Ascensores::class, inversedBy="peticiones")
     */
    private $ascensor;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInicio(): ?string
    {
        return $this->inicio;
    }

    public function setInicio(string $inicio): self
    {
        $this->inicio = $inicio;

        return $this;
    }

    public function getFinal(): ?string
    {
        return $this->final;
    }

    public function setFinal(string $final): self
    {
        $this->final = $final;

        return $this;
    }

    public function getOrigen(): ?string
    {
        return $this->origen;
    }

    public function setOrigen(string $origen): self
    {
        $this->origen = $origen;

        return $this;
    }

    public function getDestino(): ?string
    {
        return $this->destino;
    }

    public function setDestino(string $destino): self
    {
        $this->destino = $destino;

        return $this;
    }

    public function getDistancia(): ?string
    {
        return $this->distancia;
    }

    public function setDistancia(string $distancia): self
    {
        $this->distancia = $distancia;

        return $this;
    }

    public function getAscensor(): ?Ascensores
    {
        return $this->ascensor;
    }

    public function setAscensor(?Ascensores $ascensor): self
    {
        $this->ascensor = $ascensor;

        return $this;
    }

    public function getPlantasRecorridas()
    {
        return abs($this->origen-$this->destino);
    }
}
