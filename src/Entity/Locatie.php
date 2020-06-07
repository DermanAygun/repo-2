<?php

namespace App\Entity;

use App\Repository\LocatieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LocatieRepository::class)
 */
class Locatie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $naam;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adres;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $plaats;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $straat;

    /**
     * @ORM\Column(type="integer")
     */
    private $straat_nr;

    /**
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $straat_nr_bijv;

    /**
     * @ORM\ManyToMany(targetEntity=Apparaat::class, inversedBy="locaties")
     */
    private $apparaat;

    public function __construct()
    {
        $this->apparaat = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNaam(): ?string
    {
        return $this->naam;
    }

    public function setNaam(string $naam): self
    {
        $this->naam = $naam;

        return $this;
    }

    public function getAdres(): ?string
    {
        return $this->adres;
    }

    public function setAdres(string $adres): self
    {
        $this->adres = $adres;

        return $this;
    }

    public function getPlaats(): ?string
    {
        return $this->plaats;
    }

    public function setPlaats(string $plaats): self
    {
        $this->plaats = $plaats;

        return $this;
    }

    public function getStraat(): ?string
    {
        return $this->straat;
    }

    public function setStraat(string $straat): self
    {
        $this->straat = $straat;

        return $this;
    }

    public function getStraatNr(): ?int
    {
        return $this->straat_nr;
    }

    public function setStraatNr(int $straat_nr): self
    {
        $this->straat_nr = $straat_nr;

        return $this;
    }

    public function getStraatNrBijv(): ?string
    {
        return $this->straat_nr_bijv;
    }

    public function setStraatNrBijv(?string $straat_nr_bijv): self
    {
        $this->straat_nr_bijv = $straat_nr_bijv;

        return $this;
    }

    /**
     * @return Collection|Apparaat[]
     */
    public function getApparaat(): Collection
    {
        return $this->apparaat;
    }

    public function addApparaat(Apparaat $apparaat): self
    {
        if (!$this->apparaat->contains($apparaat)) {
            $this->apparaat[] = $apparaat;
        }

        return $this;
    }

    public function removeApparaat(Apparaat $apparaat): self
    {
        if ($this->apparaat->contains($apparaat)) {
            $this->apparaat->removeElement($apparaat);
        }

        return $this;
    }

    public function __toString()
    {
        return (string) $this->getNaam();
    }

}
