<?php

namespace Rs\CollezioneStronatiBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SincronizzaControllerTest extends WebTestCase
{
    public function testSincronizza()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/sincronizza');
    }

}
