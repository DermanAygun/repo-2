<?php

namespace App\Entity;

use App\Repository\ApparaatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ApparaatRepository::class)
 */
class Apparaat
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
    private $inname_door;

    /**
     * @ORM\Column(type="boolean")
     */
    private $in_elkaar;

    /**
     * @ORM\Column(type="boolean")
     */
    private $verkocht_gekocht;

    /**
     * @ORM\Column(type="date")
     */
    private $datum_inname;

    /**
     * @ORM\OneToMany(targetEntity=Onderdeel::class, mappedBy="apparaat")
     */
    private $onderdeels;

    /**
     * @ORM\ManyToMany(targetEntity=Locatie::class, mappedBy="apparaat")
     */
    private $locaties;

    public function __construct()
    {
        $this->onderdeels = new ArrayCollection();
        $this->locaties = new ArrayCollection();
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

    public function getInnameDoor(): ?string
    {
        return $this->inname_door;
    }

    public function setInnameDoor(string $inname_door): self
    {
        $this->inname_door = $inname_door;

        return $this;
    }

    public function getInElkaar(): ?bool
    {
        return $this->in_elkaar;
    }

    public function setInElkaar(bool $in_elkaar): self
    {
        $this->in_elkaar = $in_elkaar;

        return $this;
    }

    public function getVerkochtGekocht(): ?bool
    {
        return $this->verkocht_gekocht;
    }

    public function setVerkochtGekocht(bool $verkocht_gekocht): self
    {
        $this->verkocht_gekocht = $verkocht_gekocht;

        return $this;
    }

    public function getDatumInname(): ?\DateTimeInterface
    {
        return $this->datum_inname;
    }

    public function setDatumInname(\DateTimeInterface $datum_inname): self
    {
        $this->datum_inname = $datum_inname;

        return $this;
    }

    /**
     * @return Collection|Onderdeel[]
     */
    public function getOnderdeels(): Collection
    {
        return $this->onderdeels;
    }

    public function addOnderdeel(Onderdeel $onderdeel): self
    {
        if (!$this->onderdeels->contains($onderdeel)) {
            $this->onderdeels[] = $onderdeel;
            $onderdeel->setApparaat($this);
        }

        return $this;
    }

    public function removeOnderdeel(Onderdeel $onderdeel): self
    {
        if ($this->onderdeels->contains($onderdeel)) {
            $this->onderdeels->removeElement($onderdeel);
            // set the owning side to null (unless already changed)
            if ($onderdeel->getApparaat() === $this) {
                $onderdeel->setApparaat(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Locatie[]
     */
    public function getLocaties(): Collection
    {
        return $this->locaties;
    }

    public function addLocaty(Locatie $locaty): self
    {
        if (!$this->locaties->contains($locaty)) {
            $this->locaties[] = $locaty;
            $locaty->addApparaat($this);
        }

        return $this;
    }

    public function removeLocaty(Locatie $locaty): self
    {
        if ($this->locaties->contains($locaty)) {
            $this->locaties->removeElement($locaty);
            $locaty->removeApparaat($this);
        }

        return $this;
    }

    public function __toString()
    {
        return (string) $this->getNaam();
    }

}
