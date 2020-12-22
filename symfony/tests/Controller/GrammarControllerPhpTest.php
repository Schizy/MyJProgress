<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GrammarControllerPhpTest extends WebTestCase
{
    /**
     * @todo: add fixtures
     */
//    public function list()
//    {
//        $client = static::createClient();
//        $crawler = $client->request('GET', '/grammars/');
//
//        $this->assertResponseIsSuccessful();
//        $this->assertSelectorTextContains('h1', 'Liste des règles de grammaire');
//    }

    /**
     */
//    public function rule()
//    {
//        $client = static::createClient();
//        $crawler = $client->request('GET', '/grammars/1-ば');
//
//        $this->assertResponseIsSuccessful();
//        $this->assertSelectorTextContains('h1', 'grammar.name');
//    }

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
