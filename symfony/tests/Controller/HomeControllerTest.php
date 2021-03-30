<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    /**
     * @test
     */
    public function testHomePageRedirectsToDefaultLanguage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseRedirects('/ja/');
    }

    /**
     * @test
     */
    public function testHomePage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/ja/');

        $this->assertResponseIsSuccessful();
    }
}
