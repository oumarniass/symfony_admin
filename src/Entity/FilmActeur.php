<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FilmActeurRepository")
 */
class FilmActeur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_acteur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdActeur(): ?int
    {
        return $this->id_acteur;
    }

    public function setIdActeur(int $id_acteur): self
    {
        $this->id_acteur = $id_acteur;

        return $this;
    }
}
