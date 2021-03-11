<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\VarDumper\Cloner\Data;

/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 */
class Reservation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    

    /**
     * @ORM\Column(type="text")
     */
    private $message;


    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $iduser;

    /**
     * @ORM\ManyToOne(targetEntity=Proprietes::class)
     */
    private $idproduit;

    /**
     * @ORM\Column(type="date")
     */
    private $date;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getIduser(): ?User
    {
        return $this->iduser;
    }

    public function setIduser(?User $iduser): self
    {
        $this->iduser = $iduser;

        return $this;
    }

    public function getIdproduit(): ?Proprietes
    {
        return $this->idproduit;
    }

    public function setIdproduit(?Proprietes $idproduit): self
    {
        $this->idproduit = $idproduit;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;
        return $this;
    }


    
}
