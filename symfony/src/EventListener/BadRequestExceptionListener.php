<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class BadRequestExceptionListener
{
    public function __invoke(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();

        if (!$exception instanceof BadRequestHttpException
            || !str_starts_with($event->getRequest()->getRequestUri(), '/api')) {
            throw $exception;
        }

        $event->setResponse(new JsonResponse(['status' => 400, 'message' => $exception->getMessage()], 400));
    }
}
