<?php

namespace App\Api\Structures\Movie;

use App\Entity\Movie;

class MoviesList
{

    /**
     * @var Movie[]
     */
    protected $list = [];

    /**
     * MoviesList constructor.
     *
     * @param Movie[]
     */
    public function __construct(array $movies)
    {
        foreach ($movies as $movie) {
            $this->list[] = new MovieElement($movie);
        }
    }

    public function getList()
    {
        return $this->list;
    }

}