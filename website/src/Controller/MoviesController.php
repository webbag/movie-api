<?php

namespace App\Controller;

use App\Services\Movies;
use FOS\RestBundle\Controller\FOSRestController;

class MoviesController extends FOSRestController
{

    /**
     * @var Movies
     */
    protected $movies;

    /**
     * MoviesController constructor.
     *
     * @param Movies $movies
     */
    public function __construct(Movies $movies)
    {
        $this->movies = $movies;
    }

    public function getMoviesAction()
    {
        $dataMovies = $this->movies->getList();

        return $this->handleView($this->view($dataMovies, 200));
    }

    public function getMovieAction($id)
    {
        $dataMovies = $this->movies->getElement($id);

        return $this->handleView($this->view($dataMovies, 200));
    }

}
