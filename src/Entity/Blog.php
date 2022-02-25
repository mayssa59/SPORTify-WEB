<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Blog
 *
 * @ORM\Table(name="blog")
 * @ORM\Entity
 */
class Blog
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="Titre", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Champ obligatoire")
     */
    private $titre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image", type="string", length=2000, nullable=true, options={"default"="NULL"})
     */
    private $image = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="Text", type="text", length=65535, nullable=false)
     * @Assert\NotBlank(message="Champ obligatoire")

     */
    private $text;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Auteur", type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Champ obligatoire")

     */
    private $auteur;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitre(): ?string
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre(?string $titre): void
    {
        $this->titre = $titre;
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

    /**
     * @return string
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(?string $text): void
    {
        $this->text = $text;
    }

    /**
     * @return string|null
     */
    public function getAuteur(): ?string
    {
        return $this->auteur;
    }

    /**
     * @param string|null $auteur
     */
    public function setAuteur(?string $auteur): void
    {
        $this->auteur = $auteur;
    }


}
