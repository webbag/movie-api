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
     * @var array
     */
    protected $list;

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
    public function getElement(int $movieId): ?MovieElement
    {
        $result = $this->getMovie($movieId);

        return $result ? new MovieElement($result) : null;
    }

    protected function getMovie(int $movieId): MovieEntity
    {
        return $this->entityManager->getRepository(MovieEntity::class)->find($movieId);
    }

    /**
     * @param int $movieId
     * @param int $ratingNumber
     */
    public function createRating(int $movieId, int $ratingNumber)
    {
        $rating = new Rating();
        $rating->setMovieMo($this->getMovie($movieId));
        $rating->setRaRating($ratingNumber);

        $this->entityManager->persist($rating);
        $this->entityManager->flush();
    }

}
