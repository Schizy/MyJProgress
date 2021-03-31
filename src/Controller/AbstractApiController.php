<?php

namespace App\Controller;

use App\Entity\AbstractEntity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

abstract class AbstractApiController extends AbstractController
{
    public function __construct(
        protected ValidatorInterface $validator,
        protected EntityManagerInterface $em,
        protected SerializerInterface $serializer,
    ) {
    }

    protected function persist(AbstractEntity $entity): AbstractEntity
    {
        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

    protected function remove(AbstractEntity $entity)
    {
        $this->em->remove($entity);
        $this->em->flush();
    }

    protected function validate(AbstractEntity $entity): ?ConstraintViolationListInterface
    {
        $errors = $this->validator->validate($entity);
        return $errors->count() ? $errors : null;
    }

    protected function deserialize(Request $request, $class, $entityToPopulate = null)
    {
        return $this->serializer->deserialize($request->getContent(), $class, 'json', [
            AbstractNormalizer::OBJECT_TO_POPULATE => $entityToPopulate,
        ]);
    }

    protected function badRequest($errors): JsonResponse
    {
        return parent::json($errors, Response::HTTP_BAD_REQUEST);
    }

    protected function json($data, int $status = 200, array $headers = [], array $context = []): JsonResponse
    {
        return parent::json(
            $data,
            $status,
            $headers,
            $context + [
                AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object) {
                    return $object->getId();
                },
            ]
        );
    }
}
