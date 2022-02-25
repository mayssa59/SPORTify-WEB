<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Salledesport
 *
 * @ORM\Table(name="salledesport", indexes={@ORM\Index(name="fk_Region", columns={"Region"})})
 * @ORM\Entity
 */
class Salledesport
{
    /**
     * @var string
     *
     * @ORM\Column(name="ID_Salle", type="string", length=50, nullable=false)
     * @ORM\Id
     *@Assert\NotBlank(message="IDSalle is required")
     */
    private $idSalle;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom_Salle", type="string", length=50, nullable=false)
     *@Assert\NotBlank(message="NomSalle is required")
     */
    private $nomSalle;

    /**
     * @var string
     *
     * @ORM\Column(name="Adresse", type="string", length=50, nullable=false)
     *@Assert\NotBlank(message="Adresse is required")
     */
    private $adresse;

    /**
     * @var int
     *
     * @ORM\Column(name="HDebut", type="integer", nullable=false)
     *@Assert\NotBlank(message="HDebut is required")
     */
    private $hdebut;

    /**
     * @var int
     *
     * @ORM\Column(name="HFin", type="integer", nullable=false)
     *@Assert\NotBlank(message="HFin is required")
     */
    private $hfin;

    /**
     * @var int
     *
     * @ORM\Column(name="Min", type="integer", nullable=false)
     *@Assert\NotBlank(message="Min is required")
     */
    private $min;

    /**
     * @var int
     *
     * @ORM\Column(name="NumTel", type="integer", nullable=false)
     *@Assert\NotBlank(message="NumTel is required")
     * @Assert\Length(
     *
     *      max = 8,
     *      maxMessage = "Your NumTel cannot be longer than {{ limit }} characters"
     * )
     */
    private $numtel;

    /**
     * @var \Zone
     *
     * @ORM\ManyToOne(targetEntity="Zone",inversedBy="Salledesport")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Region", referencedColumnName="Region")
     * })
     */
    private $region;

    /**
     * @return string
     */
    public function getIdSalle(): ?string
    {
        return $this->idSalle;
    }

    /**
     * @param string $idSalle
     */
    public function setIdSalle(?string $idSalle): void
    {
        $this->idSalle = $idSalle;
    }

    /**
     * @return string
     */
    public function getNomSalle(): ?string
    {
        return $this->nomSalle;
    }

    /**
     * @param string $nomSalle
     */
    public function setNomSalle(?string $nomSalle): void
    {
        $this->nomSalle = $nomSalle;
    }

    /**
     * @return string
     */
    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     */
    public function setAdresse(?string $adresse): void
    {
        $this->adresse = $adresse;
    }

    /**
     * @return int
     */
    public function getHdebut(): ?int
    {
        return $this->hdebut;
    }

    /**
     * @param int $hdebut
     */
    public function setHdebut(?int $hdebut): void
    {
        $this->hdebut = $hdebut;
    }

    /**
     * @return int
     */
    public function getHfin(): ?int
    {
        return $this->hfin;
    }

    /**
     * @param int $hfin
     */
    public function setHfin(?int $hfin): void
    {
        $this->hfin = $hfin;
    }

    /**
     * @return int
     */
    public function getMin(): ?int
    {
        return $this->min;
    }

    /**
     * @param int $min
     */
    public function setMin(?int $min): void
    {
        $this->min = $min;
    }

    /**
     * @return int
     */
    public function getNumtel(): ?int
    {
        return $this->numtel;
    }

    /**
     * @param int $numtel
     */
    public function setNumtel(?int $numtel): void
    {
        $this->numtel = $numtel;
    }

    /**
     * @return Zone
     */
    public function getRegion(): ?Zone
    {
        return $this->region;
    }

    /**
     * @param \App\Entity\Zone $region
     */
    public function setRegion(?Zone $region): self
    {
        $this->region = $region;
        return $this;
    }

    public function __toString() {
        return $this->getNomSalle();
    }

}
