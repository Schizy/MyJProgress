<?php

namespace App\MessageHandler;

use App\Entity\Example;
use App\Message\ExampleMessage;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Workflow\WorkflowInterface;

class ExampleMessageHandler implements MessageHandlerInterface
{
    private $em;

    private $workflow;

    private $logger;

    public function __construct(EntityManagerInterface $em, WorkflowInterface $exampleStateMachine, LoggerInterface $amqpLogger)
    {
        $this->em = $em;
        $this->workflow = $exampleStateMachine;
        $this->logger = $amqpLogger;
    }

    public function __invoke(ExampleMessage $message)
    {
        $this->logger->info('[{id}] has been received - Handler', ['id' => $message->getId()]);

        if (!$example = $this->em->getRepository(Example::class)->find($message->getId())) {
            return;
        }

        if ($this->workflow->can($example, 'publish')) {
            $this->workflow->apply($example, 'publish');
            $this->em->flush();
        } else {
            $this->logger->alert('Transition "publish" rejected for example #' . $example->getId());
        }
    }
}
