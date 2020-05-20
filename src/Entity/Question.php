<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuestionRepository")
 */
class Question
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
    private $choixA;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $choixB;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $choixC;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $repense;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dateRepense;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChoixA(): ?string
    {
        return $this->choixA;
    }

    public function setChoixA(string $choixA): self
    {
        $this->choixA = $choixA;

        return $this;
    }

    public function getChoixB(): ?string
    {
        return $this->choixB;
    }

    public function setChoixB(string $choixB): self
    {
        $this->choixB = $choixB;

        return $this;
    }

    public function getChoixC(): ?string
    {
        return $this->choixC;
    }

    public function setChoixC(string $choixC): self
    {
        $this->choixC = $choixC;

        return $this;
    }

    public function getRepense(): ?string
    {
        return $this->repense;
    }

    public function setRepense(string $repense): self
    {
        $this->repense = $repense;

        return $this;
    }

    public function getDateRepense(): ?string
    {
        return $this->dateRepense;
    }

    public function setDateRepense(string $dateRepense): self
    {
        $this->dateRepense = $dateRepense;

        return $this;
    }
}
