<?php

namespace App\DataFixtures;

use App\Entity\Movie as MovieEntity;
use App\Entity\Rating;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class Movie extends Fixture
{
    /**
     * docker exec -it php bin/console doctrine:fixtures:load
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $dataMove = file_get_contents('https://se1.net.dvdmax.pl/app/filters/category/5');
        $dataMove = json_decode($dataMove, true);

        foreach ($dataMove['products'] as $item) {
            $movie = new MovieEntity();
            $movie->setMoTitle($item['a_name']);
            $movie->setMoDescription($this->randDescription());
            $manager->persist($movie);

            for ($i = 0; $i < rand(0, 20); $i++) {
                $rating = new Rating();
                $rating->setRaRating(rand(1, 10));
                $rating->setMovieMo($movie);
                $manager->persist($rating);
            }
            $manager->flush();
        }
    }

    /**
     * Random description.
     *
     * @return string
     */
    protected function randDescription()
    {
        $description = 'am libero tempore, cum soluta nobis est eligendi optio, cumque nihil impedit, quo minus id, quod maxime placeat, facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Qua temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet, ut et voluptates repudiandae sint et molestiae non recusandae pondere ad lineam. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat';
        $descriptionEx = explode(' ', $description);
        shuffle($descriptionEx);

        return ucfirst(implode(' ', $descriptionEx));
    }
}
