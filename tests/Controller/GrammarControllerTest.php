<?php

namespace Controller;

use App\Entity\Grammar;
use App\Repository\GrammarRepository;

class GrammarControllerTest extends FunctionalControllerTest
{
    /**
     * @var GrammarRepository
     */
    private $repository;

    public function setUp(): void
    {
        parent::setUp();

        $this->repository = $this->em->getRepository(Grammar::class);
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
