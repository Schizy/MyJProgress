<?php

namespace App\Controller;

use App\Entity\Grammar;
use App\Repository\GrammarRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/grammars')]
class GrammarApiController extends AbstractApiController
{
    #[Route('', name: 'grammars_list', methods: ['GET'])]
    public function list(GrammarRepository $grammarRepository): Response
    {
        return $this->json($grammarRepository->list(), context: ['groups' => ["id", "grammar:list"]]);
    }

    #[Route('', name: 'grammars_create', methods: ['POST'])]
    public function create(Request $request): Response
    {
        $grammar = $this->deserialize($request, Grammar::class);

        if ($errors = $this->validate($grammar)) {
            return $this->badRequest($errors);
        }

        return $this->json($this->persist($grammar), Response::HTTP_CREATED);
    }

    #[Route('/{id}', name: 'grammars_getOne', methods: ['GET'])]
    public function getOne(Grammar $grammar): Response
    {
        return $this->json($grammar);
    }

    #[Route('/{id}', name: 'grammars_update', methods: ['PATCH', 'PUT'])]
    public function update(Grammar $grammar, Request $request): Response
    {
        $grammar = $this->deserialize($request, Grammar::class, $grammar);

        if ($errors = $this->validate($grammar)) {
            return $this->badRequest($errors);
        }

        $this->em->flush();

        return $this->json($grammar);
    }

    #[Route('/{id}', name: 'grammars_delete', methods: ['DELETE'])]
    public function delete(Grammar $grammar): Response
    {
        $this->remove($grammar);

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }
}
