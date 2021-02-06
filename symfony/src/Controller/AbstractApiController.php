<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

abstract class AbstractApiController extends AbstractController
{
    protected function json($data, int $status = 200, array $headers = [], array $context = []): JsonResponse
    {
        return parent::json($data, $status, $headers,
            [
                AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                    return $object->getName();
                },
            ]
        );
    }
}
