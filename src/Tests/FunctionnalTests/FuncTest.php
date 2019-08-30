<?php


namespace App\Tests\FunctionnalTests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FuncTest extends WebTestCase
{
    function testDisplayArtist() {
        $client = static::createClient();
        $crawler = $client->request()('GET', '/products');

        $this->assertCount(1, $crawler->filter('h1'));
    }
}