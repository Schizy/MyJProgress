<?php

namespace App\Messenger;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;
use Symfony\Component\Messenger\Middleware\StackInterface;

class DoNothingMiddleware implements MiddlewareInterface, LoggerAwareInterface
{
    use LoggerAwareTrait;

    public function handle(Envelope $envelope, StackInterface $stack): Envelope
    {
        $this->logger->info("I DID IT! I DID NOTHING!");

        return $stack->next()->handle($envelope, $stack);
    }
}
