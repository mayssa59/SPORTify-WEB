<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Abonnement
 *
 * @ORM\Table(name="abonnement", indexes={@ORM\Index(name="fk_surnom", columns={"surnom_user"})})
 * @ORM\Entity(repositoryClass="App\Repository\AbonnementRepository")
 */
class Abonnement
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_abonnement", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAbonnement;

    /**
     * @var string
     *
     * @ORM\Column(name="type_abonnement", type="string", length=50, nullable=false)
     *@Assert\NotBlank(message="Champ obligatoire")
     */
    private $typeAbonnement;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_abonnement", type="float", precision=10, scale=0, nullable=false)
     *@Assert\NotBlank(message="Champ obligatoire")
     */
    private $prixAbonnement;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="DateCreation", type="datetime", nullable=true)
    /**
     * @Assert\GreaterThan("today")
     */
    private $datecreation;


    /**
     * @var string
     *
     * @ORM\Column(name="surnom_user", type="string", length=50, nullable=false)
     *@Assert\NotBlank(message="Champ obligatoire")
     */
    private $surnomUser;

    /**
     * @return int
     */
    public function getIdAbonnement(): ?int
    {
        return $this->idAbonnement;
    }

    /**
     * @param int $idAbonnement
     */
    public function setIdAbonnement(int $idAbonnement): void
    {
        $this->idAbonnement = $idAbonnement;
    }

    /**
     * @return string
     */
    public function getTypeAbonnement(): ?string
    {
        return $this->typeAbonnement;
    }

    /**
     * @param string $typeAbonnement
     */
    public function setTypeAbonnement(string $typeAbonnement): void
    {
        $this->typeAbonnement = $typeAbonnement;
    }

    /**
     * @return float
     */
    public function getPrixAbonnement(): ?float
    {
        return $this->prixAbonnement;
    }

    /**
     * @param float $prixAbonnement
     */
    public function setPrixAbonnement(float $prixAbonnement): void
    {
        $this->prixAbonnement = $prixAbonnement;
    }

    /**
     * @return \DateTime|null
     */
    public function getDatecreation(): ?\DateTime
    {
        return $this->datecreation;
    }

    /**
     * @param \DateTime|null $datecreation
     */
    public function setDatecreation(?\DateTime $datecreation): void
    {
        $this->datecreation = $datecreation;
    }

    /**
     * @return String
     */
    public function getSurnomUser(): ?String
    {
        return $this->surnomUser;
    }

    /**
     * @param String $surnomUser
     */
    public function setSurnomUser(String $surnomUser): void
    {
        $this->surnomUser = $surnomUser;
    }


}
