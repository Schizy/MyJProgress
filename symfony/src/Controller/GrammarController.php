<?php

// src/Controller/HomeController.php
namespace App\Controller;

use App\Entity\Grammar;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GrammarController extends AbstractController
{
    /**
     * @Route("/grammars/{id}-{rule}", name="grammar-rule")
     */
    public function rule(Grammar $grammar): Response
    {
        return $this->render('grammar/rule.html.twig', [
            'title' => $grammar->getName(),
            'grammar' => $grammar,
        ]);
    }

    /**
     * @Route("/grammars", name="grammar-list")
     */
    public function list(EntityManagerInterface $em)
    {
        return $this->render('grammar/list.html.twig', [
            'title' => 'Liste des règles de grammaire',
            'grammars' => $em->getRepository(Grammar::class)->findAll(),
        ]);
    }
}
