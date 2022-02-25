<?php
namespace App\Entity;
class PropertySearch
{
    /**
     * @var string
     */
    private $nomSalle;

    /**
     * @return string
     */
    public function getNomSalle(): ?string
    {
        return $this->nomSalle;
    }

    /**
     * @param string $nomSalle
     * @return PropertySearch
     */
    public function setNomSalle(String $nomSalle): self
    {
        $this->nomSalle = $nomSalle;
        return $this;
    }

}
