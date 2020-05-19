<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Entity\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProprietesRepository")
 * @UniqueEntity("titre")
 * @Vich\Uploadable()
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
     * @var string|null
     * @ORM\Column(type="string" , length=255)
     */
    private $filename;
    /**
     * @Assert\Image(
     *     mimeTypes="image/jpeg"
     * )
     * @var \Symfony\Component\HttpFoundation\File\File|null
     * @Vich\UploadableField(mapping="disque_image" , fileNameProperty="filename")
     */
    private $imagefile;
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Categori", inversedBy="Property")
     */
    private $categoris;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

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

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
    /**
     * @return string|null
     */
    public function getFilename(): ?string
    {
        return $this->filename;
    }

    /**
     * @param string|null $filename
     * @return Proprietes
     */
    public function setFilename(?string $filename): Proprietes
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\File\File|null
     */
    public function getImagefile(): ?\Symfony\Component\HttpFoundation\File\File
    {
        return $this->imagefile;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\File\File|null $imagefile
     * @return Proprietes
     */
    public function setImagefile(?\Symfony\Component\HttpFoundation\File\File $imagefile): Proprietes
    {
        $this->imagefile = $imagefile;
        if ($this->imagefile instanceof UploadedFile)
        {
            $this->updated_at = new  \DateTime('now');
        }
        return $this;
    }

}
