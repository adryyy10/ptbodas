<?php

namespace App\Entity;

use App\Repository\AscensoresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AscensoresRepository::class)
 */
class Ascensores
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $posicion;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $distancia_total;

    /**
     * @ORM\Column(type="boolean")
     */
    private $disponible;

    /**
     * @ORM\OneToMany(targetEntity=Peticiones::class, mappedBy="ascensor")
     */
    private $peticiones;

    public function __construct()
    {
        $this->peticiones = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPosicion(): ?string
    {
        return $this->posicion;
    }

    public function setPosicion(string $posicion): self
    {
        $this->posicion = $posicion;

        return $this;
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

    public function getDisponible(): ?bool
    {
        return $this->disponible;
    }

    public function setDisponible(bool $disponible): self
    {
        $this->disponible = $disponible;

        return $this;
    }

    /**
     * @return Collection|Peticiones[]
     */
    public function getPeticiones(): Collection
    {
        return $this->peticiones;
    }

    public function addPeticione(Peticiones $peticione): self
    {
        if (!$this->peticiones->contains($peticione)) {
            $this->peticiones[] = $peticione;
            $peticione->setAscensor($this);
        }

        return $this;
    }

    public function removePeticione(Peticiones $peticione): self
    {
        if ($this->peticiones->removeElement($peticione)) {
            // set the owning side to null (unless already changed)
            if ($peticione->getAscensor() === $this) {
                $peticione->setAscensor(null);
            }
        }

        return $this;
    }
}
