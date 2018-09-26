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
     * @param Movies $movies
     */
    public function __construct(Movies $movies)
    {
        $this->movies = $movies;
    }

    /**
     * @return Response
     */
    public function getMoviesAction(): Response
    {
        try {
            $code = Response::HTTP_OK;
            $response = $this->movies->getList();
        } catch (\Exception $e) {
            $response = ['message' => $e->getMessage()];
            $code = Response::HTTP_NOT_FOUND;
        }
        return $this->handleView($this->view($response, $code));
    }

    /**
     * @param $movieId int
     * @return Response
     */
    public function getMovieAction($movieId): Response
    {
        try {
            $code = Response::HTTP_OK;
            $response = $this->movies->setMovie((int)$movieId)->getElement();
        } catch (\Exception $e) {
            $response = ['message' => $e->getMessage()];
            $code = Response::HTTP_NOT_FOUND;
        }
        return $this->handleView($this->view($response, $code));
    }

    /**
     * @param $movieId int
     * @param Request $request
     * @return Response
     */
    public function postMoviesRatingAction($movieId, Request $request): Response
    {
        try {
            $code = Response::HTTP_CREATED;
            $movieId = (int)$movieId;
            $ratingNumber = $this->validationRating($request);
            $this->movies->setMovie($movieId)->createRating($ratingNumber);
            $response = $this->movies->getElement($movieId);
        } catch (\Exception $e) {
            $response = ['message' => $e->getMessage()];
            $code = Response::HTTP_BAD_REQUEST;
        }

        return $this->handleView($this->view($response, $code));
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    private function validationRating(Request $request): int
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
