<?php

namespace App\Services;

use App\Api\Structures\Movie\MovieElement;
use App\Api\Structures\Movie\MoviesList;
use App\Entity\Movie as MovieEntity;
use App\Entity\Rating;
use Doctrine\ORM\EntityManagerInterface;

class Movies
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var MovieEntity;
     */
    protected $movie;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return array|null
     */
    public function getList(): ?MoviesList
    {
        $result = $this->entityManager->getRepository(MovieEntity::class)->findAll();

        return $result ? new MoviesList($result) : null;
    }

    /**
     * @param int $movieId
     * @return MovieEntity|null
     */
    public function getElement(): ?MovieElement
    {
        $result = $this->getMovie();

        return $result ? new MovieElement($result) : null;
    }

    /**
     * @return MovieEntity
     */
    protected function getMovie(): MovieEntity
    {
        return $this->movie;
    }

    /**
     * @param $movieId int
     * @return Movies
     */
    public function setMovie(int $movieId): self
    {
        $this->movie = $this->entityManager->getRepository(MovieEntity::class)->find($movieId);

        //$this->averageRatingMovie();

        return $this;
    }

    /**
     * @param $ratingNumber
     * @throws \Exception
     */
    public function createRating($ratingNumber)
    {
        if (empty($this->getMovie())) {
            throw new \Exception('Move entity not exists');
        }

        $rating = new Rating();
        $rating->setMovieMo($this->getMovie());
        $rating->setRaRating($ratingNumber);

        $this->entityManager->persist($rating);
        $this->entityManager->flush();
    }

    protected function averageRatingMovie()
    {
        /**
         * @var $rating Rating
         */
        $rating = $this->entityManager->getRepository(Rating::class)->findBy(['movieMo' => $this->getMovie()]);

        // todo
        // sum / 10

        var_dump(count($rating)/10);
    }

}
