<?php

namespace App\Messenger;

use Psr\Log\LoggerInterface;
use Symfony\Component\Mailer\Messenger\SendEmailMessage;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;
use Symfony\Component\Messenger\Middleware\StackInterface;
use Symfony\Component\Messenger\Stamp\ConsumedByWorkerStamp;
use Symfony\Component\Messenger\Stamp\DelayStamp;
use Symfony\Component\Messenger\Stamp\ReceivedStamp;
use Symfony\Component\Messenger\Stamp\RedeliveryStamp;
use Symfony\Component\Messenger\Stamp\SentStamp;

class DoNothingMiddleware implements MiddlewareInterface
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $amqpLogger)
    {
        $this->logger = $amqpLogger;
    }

    public function handle(Envelope $envelope, StackInterface $stack): Envelope
    {
        if (null === $envelope->last(UniqueIdStamp::class)) {
            $envelope = $envelope->with(new UniqueIdStamp());
        }

        //Since the middleware call themselves in circle, we continue the chain
        //to have the other middlewares executed before we check the stamps
        $envelope = $stack->next()->handle($envelope, $stack);
        if ($envelope->getMessage() instanceof SendEmailMessage) {
            return $envelope;
        }

        $context = [
            'id' => $envelope->getMessage()->getId(),
            'uid' => $envelope->last(UniqueIdStamp::class)->getUniqueId(),
        ];

        if ($envelope->last(SentStamp::class)) {
            $this->log('has been dispatched', $context);
        }

        if ($envelope->last(ReceivedStamp::class)) {
            $this->log('has been handled', $context);
        }

        if ($envelope->last(ConsumedByWorkerStamp::class)) {
            $this->log('has been consumed', $context);
        }

        if ($envelope->last(DelayStamp::class)) {
            $this->log('has been delayed, probably a retry', $context);
        }

        if ($envelope->last(RedeliveryStamp::class)) {
            $this->log('has been redelivered, probably a failed message', $context);
        }

        return $envelope;
    }

    private function log($msg, $context)
    {
        $this->logger->info('[{uid}][{id}] ' . $msg . ' - Middleware', $context);
    }
}
