<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NotFoundExceptionListener
{
    public function __invoke(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();

        if (!$exception instanceof NotFoundHttpException
            || !str_starts_with($event->getRequest()->getRequestUri(), '/api')) {
            throw $exception;
        }

        $event->setResponse(new JsonResponse(['status' => 404, 'message' => 'This resource does not exist.'], 404));
    }
}
