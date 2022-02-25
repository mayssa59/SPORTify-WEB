<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur")
 * @ORM\Entity
 */
class Utilisateur implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="surnom", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="champ obligatoire")

     */
    private $surnom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Champ obligatoire")

     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Champ obligatoire")

     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="numeroDeTelephone", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Champ obligatoire")
     */
    private $numerodetelephone;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Champ obligatoire")

     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Champ obligatoire")

     */
    private $password;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDeNaissance", type="date", nullable=false)
     * @Assert\NotBlank(message="Champ obligatoire")

     */
    private $datedenaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Champ obligatoire")

     */
    private $sexe;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Champ obligatoire")

     */
    private $role;
    /**
     * @var string|null
     *
     * @ORM\Column(name="image", type="string", length=2000, nullable=true, options={"default"="NULL"})
     */
    private $image = 'NULL';

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(? int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getSurnom(): ?string
    {
        return $this->surnom;
    }

    /**
     * @param string $surnom
     */
    public function setSurnom(?string $surnom): void
    {
        $this->surnom = $surnom;
    }

    /**
     * @return string
     */
    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom(?string $prenom): void
    {
        $this->prenom = $prenom;
    }

    /**
     * @return string
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom(?string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getNumerodetelephone(): ?string
    {
        return $this->numerodetelephone;
    }

    /**
     * @param string $numerodetelephone
     */
    public function setNumerodetelephone(?string $numerodetelephone): void
    {
        $this->numerodetelephone = $numerodetelephone;
    }

    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return \DateTime
     */
    public function getDatedenaissance(): ?\DateTime
    {
        return $this->datedenaissance;
    }

    /**
     * @param \DateTime $datedenaissance
     */
    public function setDatedenaissance(?\DateTime $datedenaissance): void
    {
        $this->datedenaissance = $datedenaissance;
    }

    /**
     * @return string
     */
    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    /**
     * @param string $sexe
     */
    public function setSexe(?string $sexe): void
    {
        $this->sexe = $sexe;
    }

    /**
     * @return string
     */
    public function getRole(): ?string
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole(?string $role): void
    {
        $this->role = $role;
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



    public function getRoles()
    {
        return [$this->role];
    }

    public function setRoles(?string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function getUsername()
    {
        // TODO: Implement getUsername() method.
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function __toString() {
        return $this->getSurnom();
    }

    public function getutilisateur() {
        return $this->Utilisateur;
    }

    public function setutilisateur($Utilisateur) {
        $this->Utilisateur= $Utilisateur;
    }
}
