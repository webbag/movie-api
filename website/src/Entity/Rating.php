<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rating
 *
 * @ORM\Table(name="rating", indexes={@ORM\Index(name="rating_movie_mo_id_fk", columns={"movie_mo_id"})})
 * @ORM\Entity
 */
class Rating
{
    /**
     * @var int
     *
     * @ORM\Column(name="ra_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $raId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ra_rating", type="smallint", nullable=true)
     */
    private $raRating;

    /**
     * @var \Movie
     *
     * @ORM\ManyToOne(targetEntity="Movie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="movie_mo_id", referencedColumnName="mo_id")
     * })
     */
    private $movieMo;

    public function getRaId(): ?int
    {
        return $this->raId;
    }

    public function getRaRating(): ?int
    {
        return $this->raRating;
    }

    public function setRaRating(int $raRating): self
    {
        $this->raRating = $raRating;

        return $this;
    }

    public function getMovieMo(): Movie
    {
        return $this->movieMo;
    }

    public function setMovieMo(Movie $movieMo): self
    {
        $this->movieMo = $movieMo;

        return $this;
    }
    
}
