<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProprietesRepository")
 */
class Proprietes
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
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $acteurs;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $origine;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $realisateur;

    /**
     * @ORM\Column(type="date")
     */
    private $datesorti_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datecreation_at;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $producteur;

    /**
     * @ORM\Column(type="boolean",options={"default":false})
     */
    private $solde = false;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Categori", mappedBy="genre")
     */
    private $categoris;
    public function __construct()
    {
        $this->datecreation_at = new \DateTime();
        $this->categoris = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getActeurs(): ?string
    {
        return $this->acteurs;
    }

    public function setActeurs(string $acteurs): self
    {
        $this->acteurs = $acteurs;

        return $this;
    }


    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getOrigine(): ?string
    {
        return $this->origine;
    }

    public function setOrigine(string $origine): self
    {
        $this->origine = $origine;

        return $this;
    }

    public function getRealisateur(): ?string
    {
        return $this->realisateur;
    }

    public function setRealisateur(string $realisateur): self
    {
        $this->realisateur = $realisateur;

        return $this;
    }

    public function getDatesortiAt(): ?\DateTimeInterface
    {
        return $this->datesorti_at;
    }

    public function setDatesortiAt(\DateTimeInterface $datesorti_at): self
    {
        $this->datesorti_at = $datesorti_at;

        return $this;
    }

    public function getDatecreationAt(): ?\DateTimeInterface
    {
        return $this->datecreation_at;
    }

    public function setDatecreationAt(\DateTimeInterface $datecreation_at): self
    {
        $this->datecreation_at = $datecreation_at;

        return $this;
    }

    public function getProducteur(): ?string
    {
        return $this->producteur;
    }

    public function setProducteur(string $producteur): self
    {
        $this->producteur = $producteur;

        return $this;
    }

    public function getSolde(): ?bool
    {
        return $this->solde;
    }

    public function setSolde(bool $solde): self
    {
        $this->solde = $solde;

        return $this;
    }

    /**
     * @return Collection|Categori[]
     */
    public function getCategoris(): Collection
    {
        return $this->categoris;
    }

    public function addCategori(Categori $categori): self
    {
        if (!$this->categoris->contains($categori)) {
            $this->categoris[] = $categori;
            $categori->addGenre($this);
        }

        return $this;
    }

    public function removeCategori(Categori $categori): self
    {
        if ($this->categoris->contains($categori)) {
            $this->categoris->removeElement($categori);
            $categori->removeGenre($this);
        }

        return $this;
    }
}
