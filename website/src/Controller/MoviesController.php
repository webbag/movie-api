<?php

namespace App\Controller;

use App\Services\Movies;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class MoviesController extends FOSRestController
{

    /**
     * @var Movies
     */
    protected $movies;

    /**
     * @var Request
     */
    protected $request;

    /**
     * MoviesController constructor.
     *
     * @param Movies $movies
     */
    public function __construct(Movies $movies, Request $request)
    {
        $this->movies = $movies;
        $this->request = $request;
    }

    public function getMoviesAction()
    {
        $dataMovies = $this->movies->getList();

        return $this->handleView($this->view($dataMovies, 200));
    }

    public function getMovieAction($movieId)
    {
        $dataMovies = $this->movies->getElement($movieId);

        return $this->handleView($this->view($dataMovies, 200));
    }

    public function postMoviesRatingAction($movieId)
    {

        $this->request->request->get('rating');

        $this->movies->createRating($movieId);
        $dataMovies = $this->movies->getElement($movieId);

        return $this->handleView($this->view($dataMovies, 200));
    }

}
