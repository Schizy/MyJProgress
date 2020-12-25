<?php

namespace App\Tests\Controller;

use App\Entity\Grammar;
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

        $this->assertSame(1, $crawler->filter('.post-title')->count());

        $this->assertResponseIsSuccessful();
        $grammar = $client->getContainer()->get('doctrine')->getRepository(Grammar::class)->find(1);
        $this->assertSelectorTextContains('h1', $grammar->getName());
    }

    /**
     * @test
     * @depends rule
     */
    public function ruleAddExample()
    {
        $client = static::createClient();
        $client->request('GET', '/grammars/1-ば〜ほど');

        $client->submitForm('Valider', [
            'example_form[phrase]' => 'ここはどこ',
            'example_form[translation]' => 'On est où ?!',
        ]);
        $crawler = $client->followRedirect();
        $this->assertSame(2, $crawler->filter('.post-title')->count());
    }
}
