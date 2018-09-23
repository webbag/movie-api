<?php

namespace App\Api\Structures\Movie;

use App\Api\Structures\MovieTrait;
use App\Entity\Movie;

class MovieElement
{
    use MovieTrait;

    /**
     * @var Movie
     */
    protected $movie;

    /**
     * @param Movie $movie
     */
    public function __construct(Movie $movie)
    {
        $this->movie = $movie;
    }

    /**
     * todo calculate
     * @return int
     */
    public function getAverageRating():int
    {
        return 10;
    }

}
