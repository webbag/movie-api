<?php

namespace App\Services;

use App\Api\Structures\Movie\MovieElement;
use App\Api\Structures\Movie\MoviesList;
use App\Entity\Movie as MovieEntity;
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
     * @param int $id
     * @return MovieEntity|null
     */
    public function getElement(int $id): ?MovieEntity
    {
        $result = $this->entityManager->getRepository(MovieEntity::class)->find($id);

        return $result ? new MovieElement($result) : null;
    }
}
