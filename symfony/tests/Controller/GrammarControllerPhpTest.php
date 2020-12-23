<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GrammarControllerPhpTest extends WebTestCase
{
    /**
     * @test
     */
    public function list()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/grammars/');

        $this->assertSame(1, $crawler->count('.post-title'));
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Liste des règles de grammaire');
    }

    /**
     * @test
     */
    public function rule()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/grammars/1-ば〜ほど');

        $this->assertResponseIsSuccessful();
//        $this->assertSelectorTextContains('h1', 'grammar.name');
    }

    /**
     * @test
     */
    public function add()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/grammars/add');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Nouvelle grammaire');
    }
}
