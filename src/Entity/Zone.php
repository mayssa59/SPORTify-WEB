<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Zone
 *
 * @ORM\Table(name="zone")
 * @ORM\Entity
 */
class Zone
{
    /**
     * @var string
     *
     * @ORM\Column(name="Region", type="string", length=50, nullable=false)
     * @ORM\Id
     * @Assert\NotBlank(message="Region is required")

     */
    private $region;

    /**
     * @var float
     *
     * @ORM\Column(name="Lng", type="float", precision=10, scale=0, nullable=false)
     *@Assert\NotBlank(message="Longitude is required")
     */
    private $lng;

    /**
     * @var float
     *
     * @ORM\Column(name="Lat", type="float", precision=10, scale=0, nullable=false)
     *@Assert\NotBlank(message="Latitude is required")
     */
    private $lat;

    /**
     * @return string
     */
    public function getRegion(): ?string
    {
        return $this->region;
    }

    /**
     * @param string $region
     */
    public function setRegion(string $region): void
    {
        $this->region = $region;
    }

    /**
     * @return float
     */
    public function getLng(): ?float
    {
        return $this->lng;
    }

    /**
     * @param float $lng
     */
    public function setLng(float $lng): void
    {
        $this->lng = $lng;
    }

    /**
     * @return float
     */
    public function getLat(): ?float
    {
        return $this->lat;
    }

    /**
     * @param float $lat
     */
    public function setLat(float $lat): void
    {
        $this->lat = $lat;
    }
    public function __toString() {
        return $this->getRegion();
    }


}
