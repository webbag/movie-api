<?php


namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class MovieControllerTest.
 * Init  docker exec -it php bin/phpunit.
 *
 * @package App\Tests\Controller
 */
class MovieControllerTest extends WebTestCase
{

    public function testMovies()
    {
        $client = static::createClient();
        $client->request('GET', '/movies');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

    public function testMoviesById()
    {
        $client = static::createClient();
        $client->request('GET', '/movies/401');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

    public function testMoviesRatings()
    {
        $client = static::createClient();
        $client->request('GET', '/movies');
        $element = json_decode($client->getResponse()->getContent(), true);

        $movieId = $element['list'][0]['id'] ?? '';
        $rating = rand(0, 10);

        $client = static::createClient();
        $client->request('POST', '/movies/' . $movieId . '/ratings?rating=' . $rating);

        $this->assertEquals(Response::HTTP_CREATED, $client->getResponse()->getStatusCode());
    }
}
