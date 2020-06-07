<?php

namespace App\Entity;

use App\Repository\OnderdeelRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OnderdeelRepository::class)
 */
class Onderdeel
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $omschrijving;

    /**
     * @ORM\ManyToOne(targetEntity=Apparaat::class, inversedBy="onderdeels")
     */
    private $apparaat;

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

    public function getOmschrijving(): ?string
    {
        return $this->omschrijving;
    }

    public function setOmschrijving(?string $omschrijving): self
    {
        $this->omschrijving = $omschrijving;

        return $this;
    }

    public function getApparaat(): ?Apparaat
    {
        return $this->apparaat;
    }

    public function setApparaat(?Apparaat $apparaat): self
    {
        $this->apparaat = $apparaat;

        return $this;
    }
}
