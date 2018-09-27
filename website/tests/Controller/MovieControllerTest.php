<?php


namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

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
        $client->request('POST', '/movies/401/ratings?rating=9');

        $this->assertEquals(Response::HTTP_CREATED, $client->getResponse()->getStatusCode());
    }
}
