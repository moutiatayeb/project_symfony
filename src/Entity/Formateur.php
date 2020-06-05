<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FormateurRepository")
 */
class Formateur
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cours", mappedBy="formateur")
     */
    private $cours;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Condidat", inversedBy="formateurs")
     */
    private $condidat;

    public function __construct()
    {
        $this->cours = new ArrayCollection();
        $this->condidat = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * @return Collection|Cours[]
     */
    public function getCours(): Collection
    {
        return $this->cours;
    }

    public function addCour(Cours $cour): self
    {
        if (!$this->cours->contains($cour)) {
            $this->cours[] = $cour;
            $cour->setFormateur($this);
        }

        return $this;
    }

    public function removeCour(Cours $cour): self
    {
        if ($this->cours->contains($cour)) {
            $this->cours->removeElement($cour);
            // set the owning side to null (unless already changed)
            if ($cour->getFormateur() === $this) {
                $cour->setFormateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Condidat[]
     */
    public function getCondidat(): Collection
    {
        return $this->condidat;
    }

    public function addCondidat(Condidat $condidat): self
    {
        if (!$this->condidat->contains($condidat)) {
            $this->condidat[] = $condidat;
        }

        return $this;
    }

    public function removeCondidat(Condidat $condidat): self
    {
        if ($this->condidat->contains($condidat)) {
            $this->condidat->removeElement($condidat);
        }

        return $this;
    }
}
