<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategorieProduit
 *
 * @ORM\Table(name="categorie_produit", uniqueConstraints={@ORM\UniqueConstraint(name="idCategorie", columns={"idCategorie"})})
 * @ORM\Entity
 */
class CategorieProduit
{
    /**
     * @var int

     * @ORM\Column(name="idCategorie", type="integer", nullable=false)
     * @ORM\Id
     */
    private $idcategorie;

    /**
     * @var string
     *
     * @ORM\Column(name="typeCategorie", type="string", length=255, nullable=false)

     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $typecategorie;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @return int
     */
    public function getIdcategorie(): ?int
    {
        return $this->idcategorie;
    }

    /**
     * @param int $idcategorie
     */
    public function setIdcategorie(int $idcategorie): void
    {
        $this->idcategorie = $idcategorie;
    }

    /**
     * @return string
     */
    public function getTypecategorie(): ?string
    {
        return $this->typecategorie;
    }

    /**
     * @param string $typecategorie
     */
    public function setTypecategorie(string $typecategorie): void
    {
        $this->typecategorie = $typecategorie;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string|null $image
     */
    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    public function __toString()
    {
        return $this->getTypecategorie();
    }
}
