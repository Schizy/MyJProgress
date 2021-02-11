<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HttpExceptionsListener
{
    const SUPPORTED_EXCEPTIONS = [
        BadRequestHttpException::class,
        NotFoundHttpException::class,
        AccessDeniedHttpException::class,
        MethodNotAllowedHttpException::class,
    ];

    public function __invoke(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();
        $exceptionType = get_class($exception);

        if (!str_starts_with($event->getRequest()->getRequestUri(), '/api')
            || !in_array($exceptionType, self::SUPPORTED_EXCEPTIONS)) {
            throw $exception;
        }

        $status = match ($exceptionType) {
            BadRequestHttpException::class => 400,
            NotFoundHttpException::class => 404,
            AccessDeniedHttpException::class => 403,
            MethodNotAllowedHttpException::class => 405,
        };

        $event->setResponse(new JsonResponse([
            'status' => $status,
            'message' => $status == 404 ? 'This resource does not exit.' : $exception->getMessage(),
        ], $status));
    }
}
