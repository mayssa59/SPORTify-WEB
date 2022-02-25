<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Cours
 *
 * @ORM\Table(name="cours", indexes={@ORM\Index(name="fk_mail", columns={"MailCoach"}), @ORM\Index(name="fk_type", columns={"Type_Cours"})})
 * @ORM\Entity(repositoryClass="App\Repository\CoursRepository")
 */
class Cours
{
    /**
     * @var string
     *
     * @ORM\Column(name="ID_Cours", type="string", length=30, nullable=false)
     * @ORM\Id
     *  *@Assert\NotBlank(message="Champ obligatoire")
     */
    private $idCours;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="Date", type="date", nullable=true)
    /**
     * @Assert\GreaterThan("today")
     */
    private $date;

    /**
     * @var float
     *
     * @ORM\Column(name="Heure", type="float", precision=10, scale=0, nullable=false)
     * @Assert\Range(
     *      min = 8,
     *      max = 20,
     *      notInRangeMessage = "It must be between {{ min }}h and {{ max }}h",
     * )

     */
    private $heure;

    /**
     * @var int
     *
     * @ORM\Column(name="Duree", type="integer", nullable=false)
     *@Assert\NotBlank(message="Champ obligatoire")
     * @Assert\Range(
     *      min = 0,
     *      max = 240,
     *      notInRangeMessage = "It must be between {{ min }}min and {{ max }}min",
     * )
     */
    private $duree;

    /**
     * @var int
     *
     * @ORM\Column(name="Place_Disponible", type="integer", nullable=false)
     *@Assert\NotBlank(message="Champ obligatoire")
     * @Assert\Range(
     *      min = 0,
     *      max = 30,
     *      notInRangeMessage = "It must be between {{ min }}h and {{ max }}h",
     * )

     */
    private $placeDisponible;

    /**
     * @var string
     *
     * @ORM\Column(name="MailCoach", type="string", length=30, nullable=false)
     *  *@Assert\NotBlank(message="Champ obligatoire")
     */
    private $mailcoach;

    /**
     * @var \Categories
     *
     * @ORM\ManyToOne(targetEntity=Categories::class,inversedBy="Cours")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Type_Cours", referencedColumnName="Type")
     * })
     *@Assert\NotBlank(message="Type Cours is required")
     */
    private $typeCours;
    /**
     * @var string
     *
     * @ORM\Column(name="NomSalleDeSport", type="string", length=50, nullable=false)
     */
    private $nomsalledesport;
    /**
     * @return string
     */
    public function getIdCours(): ?string
    {
        return $this->idCours;
    }

    /**
     * @param string $idCours
     */
    public function setIdCours(string $idCours): void
    {
        $this->idCours = $idCours;
    }

    /**
     * @return \DateTime|null
     */
    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime|null $date
     */
    public function setDate(?\DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * @return float
     */
    public function getHeure(): ?float
    {
        return $this->heure;
    }

    /**
     * @param float $heure
     */
    public function setHeure(float $heure): void
    {
        $this->heure = $heure;
    }

    /**
     * @return int
     */
    public function getDuree(): ?int
    {
        return $this->duree;
    }

    /**
     * @param int $duree
     */
    public function setDuree(int $duree): void
    {
        $this->duree = $duree;
    }

    /**
     * @return int
     *
     */
    public function getPlaceDisponible(): ?int
    {
        return $this->placeDisponible;
    }

    /**
     * @param int $placeDisponible
     */
    public function setPlaceDisponible(int $placeDisponible): void
    {
        $this->placeDisponible = $placeDisponible;
    }

    /**
     * @return String
     */
    public function getMailcoach(): ?String
    {
        return $this->mailcoach;
    }

    /**
     * @param String $mailcoach
     */
    public function setMailcoach(?String $mailcoach): void
    {
        $this->mailcoach = $mailcoach;

    }

    /**
     * @return Categories
     */
    public function getTypeCours(): ?Categories
    {
        return $this->typeCours;
    }

    /**
     * @param \App\Entity\Categories $typeCours
     */
    public function setTypeCours(?Categories $typeCours): self
    {
        $this->typeCours = $typeCours;
        return $this;

    }

    /**
     * @return string
     */
    public function getNomsalledesport(): ?string
    {
        return $this->nomsalledesport;
    }

    /**
     * @param string $nomsalledesport
     */
    public function setNomsalledesport(?string $nomsalledesport): self

    {
        $this->nomsalledesport = $nomsalledesport;
         return $this;
    }






}
