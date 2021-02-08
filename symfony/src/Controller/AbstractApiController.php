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

abstract class AbstractApiController extends AbstractController
{
    public function __construct(
        protected ValidatorInterface $validator,
        protected EntityManagerInterface $em,
        protected SerializerInterface $serializer,
    ) {}

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

    //TODO: créer mon propre décorateur qui hérite de validator et qui formatte comme je veux
    //TODO: le tagger pour le récupérer automatiquement quand j'injecte l'interface
    protected function validate(AbstractEntity $entity): array
    {
        $errors = [];
        foreach ($this->validator->validate($entity) as $violation) {
            $errors[] = [
                'property' => $violation->getPropertyPath(),
                'message' => $violation->getMessage(),
            ];
        }

        return $errors;
    }

    protected function deserialize(Request $request, $class, $entityToPopulate = null)
    {
        return $this->serializer->deserialize($request->getContent(), $class, 'json', [
            AbstractNormalizer::OBJECT_TO_POPULATE => $entityToPopulate,
        ]);
    }

    protected function badRequest($errors): JsonResponse
    {
        return parent::json(['status' => 400, 'errors' => $errors], Response::HTTP_BAD_REQUEST);
    }

    protected function json($data, int $status = 200, array $headers = [], array $context = []): JsonResponse
    {
        return parent::json($data, $status, $headers, $context + [
                AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object) {
                    return $object->getName();
                },
            ]
        );
    }
}
