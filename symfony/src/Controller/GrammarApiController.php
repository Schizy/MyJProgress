<?php

namespace App\Controller;

use App\Entity\Grammar;
use App\Repository\GrammarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/grammars')]
class GrammarApiController extends AbstractController
{
    #[Route('', name: 'grammars_findAll', methods: ['GET'])]
    public function getAll(GrammarRepository $grammarRepository): Response
    {
        return $this->json($grammarRepository->list(), context: ['groups' => "grammar:list"]);
    }

    #[Route('/{id}', name: 'grammars_getOne', methods: ['GET'])]
    public function getOne(Grammar $grammar): Response
    {
        return $this->json($grammar);
    }

    #[Route('/{id}', name: 'grammars_delete', methods: ['DELETE'])]
    public function delete(EntityManagerInterface $em, Grammar $grammar): Response
    {
        $em->remove($grammar);
        $em->flush();

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }
}
