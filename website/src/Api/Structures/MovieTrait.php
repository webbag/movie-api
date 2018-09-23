<?php
/**
 * Created by PhpStorm.
 * User: kris
 * Date: 23.09.18
 * Time: 18:15
 */

namespace App\Api\Structures;


trait MovieTrait
{
    protected $movie;

    public function getId()
    {
        return $this->movie->getMoId();
    }

    public function getTitle()
    {
        return $this->movie->getMoTitle();
    }

    public function getDesc()
    {
        return $this->movie->getMoDescription();
    }

}