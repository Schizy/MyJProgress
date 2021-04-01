<?php

namespace Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class FunctionalControllerTest extends WebTestCase
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var \Symfony\Bundle\FrameworkBundle\KernelBrowser
     */
    protected $client;

    public function setUp(): void
    {
        $this->client = static::createClient();
        $this->em = $this->client->getKernel()->getContainer()->get('doctrine')->getManager();

        /**
         * Copy a backup test sqlite database instead of loading every fixture & purging each time
         * It's lightning fast but you need to run `make test-db` first (and every time you change the fixtures)
         */
        copy(__DIR__ . '/../test.sqlite', __DIR__ . '/../../var/data/test.sqlite');
    }
}
