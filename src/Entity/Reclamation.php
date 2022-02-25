<?php

namespace App\Entity;

use App\Repository\ReclamationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=ReclamationRepository::class)
 */
class Reclamation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     @Assert\Length(min=5,max=100,minMessage="vous devez saisir {{ limit }} caratéres!!!",maxMessage="vous devez saisir au maximum {{ limit }} caratéres!!!")
     */
    private $message;

    /**
     * @ORM\Column(type="date")
     */
    private $datereclam;

    /**
     * @ORM\ManyToOne(targetEntity=Naturereclam::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $Naturereclam;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $Utilisateur;

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

    public function getDatereclam(): ?\DateTimeInterface
    {
        return $this->datereclam;
    }

    public function setDatereclam(\DateTimeInterface $datereclam): self
    {
        $this->datereclam = $datereclam;

        return $this;
    }

    public function getNaturereclam(): ?Naturereclam
    {
        return $this->Naturereclam;
    }

    public function setNaturereclam(?Naturereclam $Naturereclam): self
    {
        $this->Naturereclam = $Naturereclam;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->Utilisateur;
    }

    public function setUtilisateur(?Utilisateur $Utilisateur): self
    {
        $this->Utilisateur = $Utilisateur;

        return $this;
    }
}
