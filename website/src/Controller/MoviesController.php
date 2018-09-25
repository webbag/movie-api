<?php

namespace App\Controller;

use App\Services\Movies;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
        $response = $this->movies->getList();

        return $this->handleView($this->view($response, Response::HTTP_OK));
    }

    public function getMovieAction($movieId)
    {
        $response = $this->movies->getElement($movieId);

        return $this->handleView($this->view($response, Response::HTTP_OK));
    }

    public function postMoviesRatingAction($movieId, Request $request)
    {
        $code = Response::HTTP_CREATED;
        try {
            $ratingNumber = $this->validationRating($request);
            $this->movies->createRating($movieId, $ratingNumber);
            $response = $this->movies->getElement($movieId);
        } catch (\Exception $e) {
            $response = ['message' => $e->getMessage()];
            $code = Response::HTTP_BAD_REQUEST;
        }

        return $this->handleView($this->view($response, $code));
    }

    private function validationRating($request)
    {
        $ratingNumber = filter_var(
            $request->get('rating'),
            FILTER_VALIDATE_INT,
            ['options' => [
                'min_range' => 1,
                'max_range' => 10,
            ]]);

        if (!$ratingNumber) {
            throw new \Exception('Parameters is out of range. Hint should be 1 to 10');
        }

        return $ratingNumber;
    }

}
