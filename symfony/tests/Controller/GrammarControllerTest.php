<?php

namespace App\Tests\Controller;

use App\Entity\Grammar;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GrammarControllerTest extends WebTestCase
{
    private $em;
    private $repository;
    private $client;

    public function setUp()
    {
        $this->client = static::createClient();

        $this->em = $this->client->getKernel()->getContainer()->get('doctrine')->getManager();
        $this->repository = $this->em->getRepository(Grammar::class);

        //Copy a backup test sqlite database instead of loading every fixture/purging each time
        copy(__DIR__ . '/../test.sqlite', __DIR__ . '/../../var/data/test.sqlite');
    }

    /**
     * @test
     */
    public function list()
    {
        $crawler = $this->client->request('GET', '/grammars/');

        $this->assertSame(1, $crawler->count('.post-title'));
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Liste des règles de grammaire');
    }

    /**
     * @test
     */
    public function rule()
    {
        $crawler = $this->client->request('GET', '/grammars/1-ば〜ほど');

        $this->assertSame(1, $crawler->filter('.post-title')->count());

        $this->assertResponseIsSuccessful();

        $grammar = $this->repository->find(1);
        $this->assertSelectorTextContains('h1', $grammar->getName());
    }

    /**
     * @test
     * @depends rule
     */
    public function ruleAddExample()
    {
        $this->client->request('GET', '/grammars/1-ば〜ほど');

        $this->client->submitForm('Valider', [
            'example_form[phrase]' => 'ここはどこ',
            'example_form[translation]' => 'On est où ?!',
        ]);
        $crawler = $this->client->followRedirect();
        $this->assertSame(2, $crawler->filter('.post-title')->count());
    }
}
