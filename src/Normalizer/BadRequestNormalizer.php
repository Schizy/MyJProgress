<?php

namespace App\Normalizer;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Validator\ConstraintViolationList;

class BadRequestNormalizer implements NormalizerInterface
{
    public function normalize($errors, string $format = null, array $context = []): array
    {
        $badRequest = ['status' => 400];

        foreach ($errors as $violation) {
            $badRequest['errors'][] = [
                'property' => $violation->getPropertyPath(),
                'message' => $violation->getMessage(),
            ];
        }

        return $badRequest;
    }

    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof ConstraintViolationList;
    }
}
