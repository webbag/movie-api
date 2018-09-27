<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Movie
 *
 * @ORM\Table(name="movie")
 * @ORM\Entity
 */
class Movie
{
    /**
     * @var int
     *
     * @ORM\Column(name="mo_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $moId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mo_title", type="string", length=255, nullable=true)
     */
    private $moTitle;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mo_description", type="text", length=65535, nullable=true)
     */
    private $moDescription;

    /**
     * @var int|null
     */
    protected $averageRating;

    public function getMoId(): ?int
    {
        return $this->moId;
    }

    public function getMoTitle(): ?string
    {
        return $this->moTitle;
    }

    public function setMoTitle(?string $moTitle): self
    {
        $this->moTitle = $moTitle;

        return $this;
    }

    public function getMoDescription(): ?string
    {
        return $this->moDescription;
    }

    public function setMoDescription(?string $moDescription): self
    {
        $this->moDescription = $moDescription;

        return $this;
    }

    public function getAverageRating(): ?int
    {
        return $this->averageRating;
    }

    public function setAverageRating($averageRating): self
    {
        $this->averageRating = $averageRating;

        return $this;
    }

}
