<?php

namespace App\MessageHandler;

use App\Entity\Example;
use App\Message\ExampleMessage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class ExampleMessageHandler implements MessageHandlerInterface
{
    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    public function __invoke(ExampleMessage $message)
    {
        if (!$example = $this->em->getRepository(Example::class)->find($message->getId())) {
            return;
        }

        $example->setState(Example::SUBMITTED);

        $this->em->flush();
    }
}
